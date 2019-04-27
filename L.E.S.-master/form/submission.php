<?php
require("../config.php");
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
} else {
    header("Location: ../homepage/login");
    exit;
}


$code = $_SESSION["code"];
$id = $_SESSION["id"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /*
    foreach ($_POST as $key => $value) {
        if (is_array($value)) {
            echo "($key -> ";
            $c = count($value);
            for($i=0; $i < $c; $i++) {
                echo $value[$i];
            }
            echo ")";
        } else {
            echo "($key -> $value)";
        }
    }
*/

    $keysArray = array_keys($_POST);
    $valuesArray = array_values($_POST);

    $columns = "";
    $rows = "";

    if ($keysArray[0] == "qCount" && $valuesArray[0] == (count($_POST)-1)) {
        $qCount = $valuesArray[0];
        unset($keysArray[0]);
        unset($valuesArray[0]);
        $columns = implode(", ", $keysArray);
        
        foreach ($valuesArray as $key => $value) {
            if (is_array($value)) {
                $valuesArray[$key] = implode ($value);
            }
        }
        $rows = implode("', '", $valuesArray);
    } else {
        exit("Unable to submit the evaluation.");
    }

    $query = "INSERT INTO responses (formId, email, $columns) VALUES ((SELECT f.id FROM forms f WHERE f.code = '$code'), '$id', '$rows')";


    $resultID = $conn->query($query);


}

session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <title>Thank You</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../globalStyle.css">
    </head>
    <body>
            <div class="headPanel">
                <div id="logoBox">
                    <img class="logo" src="../source/logo.png" alt="university_of_pittsburgh_logo">
                    <h1 id="pageName">L.E.S.</h1>
                </div>
                <div>
                    <h1 id="right">PSY-0010</h1>
                </div>
            </div>
            <div class="bodyPanel">
                <div id="form">
                    <h2 class="qTitle">Submitted sucessfull, thank you for submitting the evaluation.</h2>
                </div>
            </div>
    </body>
</html>

