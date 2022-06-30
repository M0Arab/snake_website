<?php
require "config.php";

session_start();
$message="";

if(count($_POST)>0) {


    $db_host = 'localhost';
    $db_user = 'db86916';
    $db_pass = 'thanki11';
    $db_data = '86916_alg';

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_data);
    $username = $_POST["user_name"];
    $password = $_POST["password"];

    $stmt = $con->prepare("SELECT * FROM login_user WHERE user_name=? AND password=md5(?);");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();


    $result = mysqli_query($mysqli,"SELECT * FROM login_user WHERE user_name='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
    $row  = mysqli_fetch_array($result);
    if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['name'];
        $_SESSION["isAdmin"] = $row['rollen'];
    } else {
        $message = "De gegevens die je hebt ingevuld zijn fout";
    }
}
if(isset($_SESSION["name"])) {
    header("Location:maps.php");
}
?>

<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand bg-green">
    <a class="navbar-brand" href="#"><img src="./img/logo.png" style="height:50px" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link nav-link-white" href="logout.php" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Log In</a>
        </div>
    </div>
</nav>
<div class="message"><?php if($message!="") { echo $message; } ?></div>


<div class="login-box">
    <h2>Login</h2>
    <form name="frmUser" method="post" action="">
        <div class="user-box">
            <input type="text" name="user_name" required="">
            <label>Username</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required="">
            <label>Password</label>
        </div>
        <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <input type="submit" name="submit" value="Login" class="button">

        </a>
    </form>
