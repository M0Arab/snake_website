<?php
require "config.php";
if(count($_REQUEST)>0) {
    $username = $_REQUEST["user_name"];
    $password = $_REQUEST["password"];
    $name = $_REQUEST["name"];
    $isAdmin = 0;
    $userQuery = "SELECT * FROM login_user WHERE user='{$username}'";
    $res = mysqli_query($mysqli,$userQuery);
    if(mysqli_num_rows($res) > 0){
        echo "gebruikersnaam bestaat al, probeer een andere gebruikersnaam";
        return header("Refresh: 3, url=register_form.html");
    }
    $query = "INSERT INTO login_user (name,user_name,password,rollen) VALUES ('{$name}','{$username}','{$password}','{$isAdmin}')";

    if(mysqli_query($mysqli,$query)){
        echo "Uw account is aangemaakt";
        return header("Refresh: 3, url=maps.php");
    }
    else{
        echo "Account aanmaken is niet gelukt";
        return header("Refresh: 10, url=maps.php");
    }
}
else{
    echo "Account aanmaken is niet gelukt";
    return header("Refresh: 10, url=maps.php");
}