<?php
require "config.php";
session_start();
$snake_id = $_GET["p_id"];
if(!$snake_id && !$_SESSION["name"]){
    return header("Location:index.php");
}
$row = "";
$query = "SELECT * FROM slangen WHERE id={$snake_id}";
$result = mysqli_query($mysqli,$query);
if(mysqli_num_rows($result) > 0){
    $row = $result ->fetch_assoc();
}
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/create_snake_style.css">
    <link rel="stylesheet" href="css/maps.css" />
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
<div class="login-box">
    <h2>Slang aanmelden</h2>
    <form  method="post" action="update.php" enctype="multipart/form-data">
        <input type="hidden" name="p_id" value="<?php echo $snake_id?>">
        <div class="user-box">
            <input type="datetime-local" name="datum" id="datum" value="<?php echo $row['datum']?>">
            <label>Datum</label>
        </div>
        <div class="user-box">
            <input type="text" name="leeftijd" id="leeftijd"  value="<?php echo $row['leeftijd']?>">
            <label>Leeftijd</label>
        </div>
        <div class="user-box">
            <input type="text" name="toestand" id="toestand"  value="<?php echo $row['toestand']?>">
            <label>Toestand</label>
        </div>
        <div class="user-box">
            <input type="text" name="slang" id="slang"  soort" value="<?php echo $row['slang']?>">
            <label>Slang</label>
        </div>
        <div class="user-box">
            <input type="file" name="foto" id="foto">
            <label>Foto</label>
        </div>

        <button class="submitButton" type="submit">Bevestig</button>
    </form>
</div>
</div>

<!--<div class="login-box">-->
<!--    <h2>Login</h2>-->
<!--    <form name="frmUser" method="post" action="">-->
<!--        <div class="user-box">-->
<!--            <input type="text" name="user_name" required="">-->
<!---->
<!--        </div>-->
<!--        <div class="user-box">-->
<!--            <input type="password" name="password" required="">-->
<!--            <label>Password</label>-->
<!--        </div>-->
<!--        <a href="#">-->
<!--            <span></span>-->
<!--            <span></span>-->
<!--            <span></span>-->
<!--            <span></span>-->
<!--            <input type="submit" name="submit" value="Login" class="button">-->
<!---->
<!--        </a>-->
<!--    </form>-->

</body>
</html>