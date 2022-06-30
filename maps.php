<?php

require 'config.php';
session_start();


if(isset($_SESSION["name"])) {
?>
    <!DOCTYPE html>
    <!--
     @license
     Copyright 2019 Google LLC. All Rights Reserved.
     SPDX-License-Identifier: Apache-2.0
    -->
    <html>
    <head>
        <title>Snake Patrol</title>
        <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
        <script src="js/multiselect-dropdown.js" ></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <!-- jsFiddle will insert css and js -->
        <link rel="stylesheet" href="css/maps.css" />
        <link rel="stylesheet" href="css/login.css" />

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="js/maps.js" asp-append-version="true"></script>
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

                <a class="nav-item nav-link nav-link-white" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Meld een slang</a>
                <a class="nav-item nav-link nav-link-white" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight2" aria-controls="">Filter meldingen</a>
                <?php
                if(isset($_SESSION["id"])){
                    echo '<a class="nav-item nav-link nav-link-white" href="/snake/logout.php">Uitloggen</a>';
                if($_SESSION["isAdmin"]){
                    echo ' <a class="nav-item nav-link nav-link-white" href="/snake/account_aanmaken.html">Account Aanmaken</a>';
                }
                if($_SESSION["name"]){
                    echo ' <a class="nav-item nav-link nav-link-white" href="/snake/index.php">Index</a>';
                }
                }
                ?>
            </div>
        </div>
        <h1 class="nav-item nav-link nav-link-white right"><?php echo $_SESSION['name'];?></h1>
    </nav>

    <div id="map"></div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Slang melding</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="snakeForm" method="post" action="insert.php" enctype="multipart/form-data">
            <div id="form">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            Door
                            <input class="user-box" type="text" name="name" id="name" placeholder="Gemaakt door" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Datum en tijd
                        </div>
                        <div class="col">

                            <input name="datum" id="datum" type="datetime-local"  required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">

                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            Slang
                        </div>
                        <div class="col">

                            <select name="slang" id="slang">
                                <option value="Python">Python</option>
                                <option value="Ringslang">Ringslang</option>
                                <option value="Black momba">Black mamba</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" width="100px">
                            Leeftijd
                        </div>
                        <div class="col">
                            <select name="leeftijd" id="leeftijd" required>
                                <option value="Juvenal">Juvenal</option>
                                <option value="Subadult">Subadult</option>
                                <option value="Adult">Adult</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" width="100px">
                            Toestand
                        </div>
                        <div class="col">
                            <select  name="toestand" id="toestand" multiple multiselect-search="true" multiple multiselect-select-all="true" required>
                                <option value="Mager"> Mager </option>
                                <option value="Teken"> Teken </option>
                                <option value="Wondjes"> Wondjes</option>
                                <option value="Slechte vervelling">Slechte vervelling </option>
                                <option value="Gezond">Gezond </option>
                                <option value="In huis">In huis </option>
                                <option value="In de tuin">In de tuin </option>
                                <option value="In de schuur">In de schuur </option>
                                <option value=" In de ren">In de ren </option>
                                <option value=" Anders...">Anders... </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5>Foto</h5>
                        </div>
                    </div>
                    <div class="row" width="100px">
                        <div class="col">
                            <input type="file" name="image" id="image" required />
                        </div>
                        <button class="submitButton" name="verzend" type="submit">Bevestig</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight2" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Filter melding</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="snakeForm" method="post" action="filter.php" enctype="multipart/form-data">
                <div id="form">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <p> Door</p>
                                <input type="text" name="name" id="name" placeholder="Gemaakt door">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Datum en tijd
                            </div>
                            <div class="col">

                                <input name="datum" id="datum" type="datetime-local" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">

                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                Slang
                            </div>
                            <div class="col">

                                <select name="slang" id="slang">
                                    <option value="Python">Python</option>
                                    <option value="Ringslang">Ringslang</option>
                                    <option value="Black momba">Black momba</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" width="100px">
                                Leeftijd
                            </div>
                            <div class="col">
                                <select name="leeftijd" id="leeftijd">
                                    <option value="Juvenal">Juvenal</option>
                                    <option value="Subadult">Subadult</option>
                                    <option value="Adult">Adult</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" width="100px">
                                Toestand
                            </div>
                            <div class="col">
                                <select  name="toestand[]" id="toestand" multiple >
                                    <option value="Mager"> Mager </option>
                                    <option value="Teken"> Teken </option>
                                    <option value="Wondjes"> Wondjes</option>
                                    <option value="Slechte vervelling">Slechte vervelling </option>
                                    <option value="Gezond">Gezond </option>
                                    <option value="In huis">In huis </option>
                                    <option value="In de tuin">In de tuin </option>
                                    <option value="In de schuur">In de schuur </option>
                                    <option value=" In de ren">In de ren </option>
                                    <option value=" Anders...">Anders... </option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>Foto</h5>
                            </div>
                        </div>
                        <div class="row" width="100px">
                            <div class="col">
                                <input type="file" name="image" id="image" />
                            </div>
                            <button class="submitButton" name="verzend" type="submit">Bevestig</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    <!--
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
     <?php
}
else {
    header("Location:login.php");
}
?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8jcY8KAr2Q8QcMZ17s3iMCMEX3ZGkPxs&callback=initMap&v=weekly"
            defer></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
    </html>


