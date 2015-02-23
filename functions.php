<?php
//connect to database
$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'peeplesj-db', 'jhNqh46GyMrkQZuS', 'peeplesj-db');
if($mysqli->connect_error){
    die('Connection Error: ' . $mysqli->connect_erno . ', ' . $mysqli->connect_error);
}

function getMovieTable($mysqli){
    return $mysqli->query("SELECT * FROM tblVideo;");
}

function deleteTable($mysqli){
    return $mysqli->query("DELETE FROM tblVideo WHERE 1;");
}

function deleteMovie($movieID, $mysqli){
    return $mysqli->query("DELETE FROM tblVideo WHERE id=$movieID;");
}

function addMovie($movieName, $movieCategory, $movieLength, $mysqli){
    return $mysqli->query("INSERT INTO tblVideo (name, category, length) VALUES ('$movieName', '$movieCategory', '$movieLength');");
}

function checkOut($movieID, $mysqli){
    return $mysqli->query("UPDATE tblVideo SET rented=1 WHERE id=$movieID;");
}

function checkIn($movieID, $mysqli){
    return $mysqli->query("UPDATE tblVideo SET rented=0 WHERE id=$movieID;");
}

function createCategories($mysqli){
    return $mysqli->query("SELECT DISTINCT category FROM tblVideo where category <> '';");
}
?>
    