<?php
$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'peeplesj-db', 'jhNqh46GyMrkQZuS', 'peeplesj-db');
if($mysqli->connect_error){
    die('Connection Error: ' . $mysqli->connect_erno . ', ' . $mysqli->connect_error);
}

function getMovieTable($mysqli){
    return $mysqli->query("SELECT * FROM tblVideo;");
}

function addMovie($movieName, $movieCategory, $movieLength, $mysqli){
    return $mysqli->query("INSERT INTO tblVideo (name, category, length) VALUES ('$movieName', '$movieCategory', '$movieLength');");
}




?>
    