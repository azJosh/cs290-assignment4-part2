<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require('functions.php');

//Add movie
if (array_key_exists('addMovie', $_POST)) {
    if(empty($_POST['movieName'])){
        exit('Please provide a movie name.');
    }
    if($_POST['movieLength']<=0){
        exit('The lenght must be greater than 0.');
    }
    addMovie($_POST['movieName'], $_POST['movieCategory'], $_POST['movieLength'], $mysqli);
}
//Check out
if(array_key_exists('checkOut', $_POST)) {
    checkOut($_POST['checkOut'], $mysqli);
}
//Check in
if(array_key_exists('checkIn', $_POST)) {
    checkIn($_POST['checkIn'], $mysqli);
}
//Delete single movie
if(array_key_exists('deleteRow', $_POST)) {
    deleteMovie($_POST['deleteRow'], $mysqli);
}
//Delete entire table
if(array_key_exists('deleteTable', $_POST)) {
    deleteTable($mysqli);
}

//Create variables
$movies = getMovieTable($mysqli);
$movieCats = createCategories($mysqli);

//Apply filter
if ($_POST['filter'] != 'allCategories' && array_key_exists('filterMovies', $_POST)){
    $moviesFiltered = array();
    foreach ($movies as $key => $value){
        if ($value['category'] == $_POST['filter']){
            $moviesFiltered[] = $value;
        }
    }
    $movies = $moviesFiltered;
    unset($moviesFiltered);
} 
        
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Movie Rental Database</title>
</head>
<body>
    <h1>Movie Rental Database</h1>
    <h2>Add Movie to Database</h2>
    <div>
        <form action='interface.php' method="POST">
            Movie Name: <input type='text' name='movieName' required></input>
            Category: <input type='text' name='movieCategory'></input>
            Length(minutes): <input type='number' name='movieLength'></input>
            <input type='hidden' name='addMovie' value='TRUE'></input>
            <br><input type='submit' value='Add Movie'></input>
        </form><br><br>
            <form action='interface.php' method="POST">
            <input type='hidden' name='deleteTable' value='TRUE'></input>
            <input type='submit' value='Delete All Movies'></input>
        </form>
    </div>


<?php

    echo '<div>';
    echo "<h2>Movie Table</h2>";
    echo '<p>Movie Category Filter: <p>';
    echo '<form action="interface.php" method="POST">' .
            '<select name="filter">' . 
            '<option value="allCategories">' . 'All Categories' . '</option>';

    foreach ($movieCats as $key => $value){
        
        echo '<option value="' . $value['category'] . '">' .  
        $value['category'] . '</option>';
    }

    echo '</select>';
    echo '<input type="hidden" name="filterMovies" value="TRUE">';
    echo '<input type="submit" value="Apply">';
    echo '</form>';
             
    echo "<div><table border='1' cellpadding='5'>";
    echo "<tr><th>Movie Name</th><th>Category</th><th>Length</th><th>status</th><th>Check In/Out</th><th>Delete</th>";

    foreach ($movies as $key => $value){

        echo '<tr><td>' . $value['name'] . '</td><td>' . $value['category'] . '</td><td>';

        echo $value['length'] . '</td><td>';

        if ($value['rented'] == 1){
            echo 'Checked Out' . '</td><td>' .
            '<form action="interface.php" method="POST">' .
            '<input type="hidden" name="checkIn" value="' . $value['id'] . '">' .
            '<input type="submit" value="Check In">' . '</form>';
        }
        else{
             echo 'Available' . '</td><td>' .
            '<form action="interface.php" method="POST">' .
            '<input type="hidden" name="checkOut" value="' . $value['id'] . '">' .
            '<input type="submit" value="Check Out">' . '</form>';
        }
        echo '</td><td>' .
        '<form action="interface.php" method="POST">' .
        '<input type="hidden" name="deleteRow" value="' . $value['id'] . '">' .
        '<input type="submit" value="Delete">' . '</form>';

        echo '</td></tr>';
    }
    echo '</table></div>';
?>

   
  </body>
</html>
    
    
    