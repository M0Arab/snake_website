<?php
session_start();
?>
<!DOCTYPE html>
<!--
 @license
 Copyright 2019 Google LLC. All Rights Reserved.
 SPDX-License-Identifier: Apache-2.0
-->
<html>
<head>
    <title>Overzicht</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <script src="js/multiselect-dropdown.js" ></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" defer></script>
    <!-- jsFiddle will insert css and js -->
    <link rel="stylesheet" href="css/maps.css" />
    <link rel="stylesheet" href="css/index_style.css" />

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>


        .bg-green {
            background-color: #385631;
        }

        .nav-link-white {
            color: white;
        }

        .right{
            padding-right:25px;
            padding-top:10px;
        }




    </style>
</head>
<body>
<nav class="navbar navbar-expand bg-green">
    <a class="navbar-brand" href="#"><img src="./img/logo.png" style="height:50px" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">

            <a class="nav-item nav-link nav-link-white" href="maps.php" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Home</a>
            <?php
            if(isset($_SESSION["id"])){
                echo '<a class="nav-item nav-link nav-link-white" href="/snake/logout.php">Uitloggen</a>';
                if($_SESSION["isAdmin"]){
                    echo ' <a class="nav-item nav-link nav-link-white" href="/snake/account_aanmaken.html">Account Aanmaken</a>';
                }
                if($_SESSION["isAdmin"]){
                    echo ' <a class="nav-item nav-link nav-link-white" href="/snake/index.php">Index</a>';
                }
            }
            ?>
        </div>
    </div>
    <h1 class="nav-item nav-link nav-link-white right"><?php echo $_SESSION['name'];?></h1>
</nav>
<div class="productsContainer">
    <?php
    require "config.php";
    $query = "SELECT * FROM slangen";
    $result = mysqli_query($mysqli,$query);
    if(mysqli_num_rows($result) > 0){
        while($row = $result -> fetch_assoc()){
            $id = $row["id"];
            $username = $row["name"];
            $datum = $row["datum"];
            $slang = $row["slang"];
            $leeftijd = $row["leeftijd"];
            $toestand = $row["toestand"];
            $image = $row["foto"];
            echo '<div class="productCard">';
            echo    '<div class="productImage">';
            echo        "<img src=/snake{$image} width='100%' height='100%' loading='lazy' />";
            echo    '</div>';
            echo    '<div class="productTitleWrapper">';
            echo        "<h2>{$username}</h2>";
            echo        "<p>{$datum}</p>";
            echo    '</div>';
            echo    '<div class="productCategoryWrapper">';
            echo        "<h4>{$slang}</h4>";
            echo    '</div>';
            echo    '<div class="productDescWrapper">';
            echo        "<p>{$toestand}</p>";
            echo    '</div>';
            echo    '<div class="productActionsWrapper">';
            echo        '<div class="productRatingWrapper">';
            if($_SESSION['name']){
                echo  "<button class='deleteButton' onclick='deleteSlang(this)' id={$id}>verwijderen</button>";
                echo  "<button class='rateButton' onclick='editSlang(this)' id={$id}>bewerken</button>";
            }
            echo        '</div>';
            echo        '<div class="productPriceWrapper">';
            echo            "<h3>{$leeftijd}</h3>";
            echo        '</div>';
            echo    '</div>';
            echo '</div>';
        }
    }


    ?>
</div>
<script>

    function deleteSlang(el){
        let delete_snake_id = el.id
        $.ajax({
            type: "POST",
            url : "/snake/delete.php",
            data: {snake_id : delete_snake_id},
            success: (res) =>{
                location.reload()
            },
        })
    }

    function editSlang(el){
        const id = el.id
        location.href = "https://86890.ict-lab.nl/snake/update_snake.php?p_id="+id
    }
</script>
</body>
</html>