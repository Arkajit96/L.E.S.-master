<!DOCTYPE html>
<?php
session_start();

if ($_SESSION["error"] != "0") {
    switch ($_SESSION["error"]) {
        case "1":
            echo "<script type='text/javascript'>window.alert('A code and an email is required')</script>";
            break;
        case "2":
            echo "<script type='text/javascript'>window.alert('Please enter a valid code!')</script>";
            break;
        case "3":
            echo "<script type='text/javascript'>window.alert('Please enter a valid email!')</script>";
            break;
        case "4":
            echo "<script type='text/javascript'>window.alert('This email has already been used to answer this survey!')</script>";
            break;
    }
    session_unset();
    session_destroy();
}
?>


<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <title>L.E.S.</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <div class="panel">
            <img class="logo" src="../source/logo.png" alt="university_of_pittsburgh_logo">
            <h1 class="name">L.E.S.</h1>
            <form action="auth" method="POST">
                <input type="text" name="code" placeholder="Enter Code">
                <input id="email" type="text" name="email" placeholder="email">
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>
