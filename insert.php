<?php
    require 'config.php';
    session_start();

    $id = $_REQUEST['id'];
    $username = $_REQUEST['name'];
    $datum = $_REQUEST['datum'];
    $slang = $_REQUEST['slang'];
    $leeftijd = $_REQUEST['leeftijd'];
    $toestand = $_REQUEST['toestand'];

    $target_dir = "/images/";
    $imageFileType = strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
    $target_file = $target_dir . basename(time(). "." . $imageFileType);

    $image = $_FILES['image']['name'];
    if(!$_SESSION['name']){
        return header("Location:maps.php");

    }
    if(isset($username) && isset($datum) && isset($slang) && isset($leeftijd) && isset($toestand) && isset($image)) {
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return header("Location:maps.php");
        }
        if(move_uploaded_file($_FILES['image']['tmp_name'],__DIR__.$target_file)){
            echo $username, $datum, $leeftijd, $toestand, $target_file,$slang;
            $query = "INSERT INTO slangen (username,datum,leeftijd,toestand,foto,slang) VALUES
                                           ('{$username}','{$datum}','{$leeftijd}','{$toestand}','{$target_file}','{$slang}')";
            if(mysqli_query($mysqli,$query)){
                return header("Location:maps.php");
            }
            else{

                echo "Het melden van slang is niet gelukt \n u wordt automatisch doorgestuurd naar de vorige pagina";
                return header("Refresh:5, url=maps.php");
            }
        }
        else{
            echo "Er is iets fout gegaan";

        }

    }
    else{
        echo "Er is iets fout gegaan ";
        return header("Refresh:5, url=maps.php");
    }
