<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include "includes/functions.php";
signUp();
?>

<head>
    <title>
        MedCheck
    </title>
    <link rel="icon" href="images/logo.png" type="image/icon type">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<!------ Include the above in your HEAD tag ---------->
<div class="container">
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">


        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Registrieren</div>
            </div>
            <?php

            message();
            ?>
            <div class="panel-body">
                <form id="signupform" class="form-horizontal" role="form" method="post" action="signUp.php">
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">E-Mail</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">Vorname</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="Fname" placeholder="Vorname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-md-3 control-label">Nachname</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="Lname" placeholder="Nachname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-md-3 control-label">Adresse</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="address" placeholder="Adresse">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Passwort</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="passwd" placeholder="Passwort">
                        </div>
                    </div>
                    <div style=" margin-left: 39px;">
                        <b> Das Passwort muss folgendes enthalten:</b>
                        <ul>
                            <li>mindestens 1 Nummer und 1 Buchstaben</li>
                            <li>Muss 8-30 Zeichen lang sein</li>
                        </ul>
                    </div>


                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <input id="btn-login" class="btn btn-info" type="submit" value="Registrieren" name="singUp" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                Sie haben bereits ein Konto?!
                                <a href="login.php">
                                    Hier anmelden
                                </a>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>