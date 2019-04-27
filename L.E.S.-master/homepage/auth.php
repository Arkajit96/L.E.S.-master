<?php
require("../config.php");
session_start();

//echo $_SERVER["REQUEST_METHOD"];
$_SESSION["error"] = "0";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["code"]) || empty($_POST["email"])) {
        $_SESSION["error"] = "1";
    } else {
        $code = htmlspecialchars($_POST["code"]);
        $email = htmlspecialchars($_POST["email"]);

        $query = "SELECT s.email FROM students s WHERE s.id IN(SELECT studentID FROM $code);";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"] = "3";
        } else {
            $query = "SELECT f.id FROM forms f WHERE f.code='$code'";
            $resultID = $conn->query($query);
            $rowCount = mysqli_num_rows($resultID);
            if ($rowCount == 1) {
                $match = 0;
                $formID = $resultID->fetch_assoc();
                $query = "SELECT r.email FROM responses r WHERE r.formId = (SELECT f.id from forms f WHERE f.code = '$code') AND r.email = '$email';";
                $resultEmail = $conn->query($query);
                $row = mysqli_num_rows($resultEmail);
                if ($row > 0) {
                    $_SESSION["error"] = "4";
                } else {
                    session_unset();
                    $_SESSION["code"] = $code;
                    $_SESSION["id"] = $email;
                    $_SESSION["loggedin"] = true;
                    header("Location: ../form/".$code, true, 301);
                    exit();
                }
            } else {
                $_SESSION["error"] = "2";
            }
        }
    }
    header("Location: login", true, 301);
    exit();
}
//echo $_SESSION["error"];
?>