<?php
    $host = "localhost";
    $username = "db86916";
    $password = "thanki11";
    $database = "86916_alg";


    $mysqli = mysqli_connect($host, $username, $password, $database);

if(!$mysqli) {
    echo "FOUT: geen connectie naar database. <br>";
    echo "Error: " . mysqli_connect_error() . "<br/>";
    exit;
}


?>