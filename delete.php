<?php
require "config.php";
session_start();
$snake_id = $_REQUEST["snake_id"];
if($snake_id && $_SESSION['name']){
    $get_art_query = "SELECT * FROM slangen WHERE ID={$snake_id}";
    $match_res = mysqli_query($mysqli,$get_art_query);
    $match = $match_res -> fetch_assoc();
    unlink(__DIR__.$match["foto"]);
    $query = "DELETE FROM slangen WHERE ID={$snake_id}";
    $query_res = mysqli_query($mysqli,$query);
    if( $query_res){
        echo "true";
    }
    else{
        echo "false";
    }
}
else{
    echo "false";
}