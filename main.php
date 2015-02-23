<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('functions.php');

if(array_key_exists('addMovie', $_POST){
    if(empty($_POST['movieName'])){
        exit('Please provide a movie name.');
    }
    if(!is_int($_POST['movieLength']) || $_POST['movieLength']<=0){
        exit('The lenght must be an integer greater than 0.');
    }
    addMovie($_POST['movieName'], $_POST['movieCategory'], $_POST['movieLength'], $mysqli);
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
    <form action='main.php' method="POST">
        Movie Name: <input type='text' name='movieName' required></input>
        Category: <input type='text' name='movieCategory'></input>
        Length(minutes): <input type='number' name='movieLength'></input>
        <input type='hidden' name='addMovie' value='TRUE'></input>
        <br><input type='submit' value='Add Movie'></input>
    </form><br><br>
<?php

$video = getMovieTable($mysqli);




echo "<h2>Movie Table</h2>";
echo "<div><table border='1' cellpadding='10'>";
echo "<tr><th>Movie Name</th><th>Category</th><th>Length</th><th>status</th><th>Check In/Out</th><th>Delete</th>";

while($row = $video->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['category'] . "</td>";
    echo "<td>" . $row['length'] . "</td>";
    echo "<td>" . $status . "</td>";
    
    if($row['rented'] == 1){
        echo "<td>
        <form action="main.php" method="POST">
            <input type='hidden' name='checkIn' value="' . $row['id'] . '">
            <input type='submit' value='Check In'>
        </form></td>";
        
    }else {
        echo "<td>
        <form action="main.php" method="POST">
            <input type='hidden' name='checkOut' value="' . $row['id'] . '">
            <input type='submit' value='Check Out'>
        </form></td>";
    }
    
    echo "<td>
    <form action="main.php" method="POST">
        <input type='hidden' name='deleteRow' value="' . $row['id'] . '">
        <input type='submit' value='Delete'>
    </form></td>";
    echo "</tr>";
}
echo "</table>";


?>


    
    
    