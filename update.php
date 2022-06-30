<?php

require "config.php";
session_start();
$id = $_REQUEST['p_id'];
$datum = $_REQUEST['datum'];
$slang = $_REQUEST['slang'];
$leeftijd = $_REQUEST['leeftijd'];
$toestand = $_REQUEST['toestand'];

$target_dir = "/images/";
$imageFileType = strtolower(pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION));
$target_file = $target_dir . basename(time(). "." . $imageFileType);

$image = $_FILES['foto']['name'];
if (!$_SESSION['name']) {
    return header("Location:index.php");
}
if ( $datum && $slang && $toestand && $leeftijd) {
    if($image != ""){
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return header("Location:index.php");
        }
        if (move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . $target_file)) {
            echo $target_file;
            $query = "UPDATE slangen SET datum='{$datum}',leeftijd='{$leeftijd}',toestand='{$toestand}',foto='{$target_file}',slang='{$slang}' WHERE id={$id}";
            if (mysqli_query($mysqli, $query)) {
                return header("Location:index.php");
            } else {
                echo "abdu";
                echo "Het melden van slang is niet gelukt \n u wordt automatisch doorgestuurd naar de hoofdpagina";
                return header("Refresh:3, url=index.php");
            }
        } else {
            echo "failed to upload";
        }
    }
    else{
        $query = "UPDATE slangen SET datum='{$datum}',leeftijd='{$leeftijd}',toestand='{$toestand}',slang='{$slang}' WHERE id={$id}";
        if (mysqli_query($mysqli, $query)) {
            return header("Location:index.php");
        } else {
            echo "Het melden van slang is niet gelukt \n u wordt automatisch doorgestuurd naar de hoofdpagina";
            return header("Refresh:3, url=index.php");
        }
}
}
else {
    $query = "UPDATE slangen SET datum='{$datum}',leeftijd='{$leeftijd}',toestand='{$toestand}',slang='{$slang}' WHERE id={$id}";
    echo $query;
    echo "missing values";
    return header("Refresh:300, url=index.php");
}