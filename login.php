<?php
    // Check if username and password are initialized
    if (isset($_POST["username"]) and isset($_POST["password"])) {
        // Initialize variables
        $account = $_POST["username"].":".$_POST["password"];
        $accountList = file("passwd.txt", FILE_IGNORE_NEW_LINES);

        // Check if username and password are valid
        if (in_array($account, $accountList)) {
            session_start();
            $_SESSION["status"] = true;
            header("Location: actions.php");
            exit;
        } else {
            echo '<script>
                window.alert("Login Failed.");
            </script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Student Records: Login</title>
        <meta charset="UTF-8">
        <meta name="description" content="SQL database">
        <meta name="author" content="Ryan Truong">
        <style><?php include "database.css";?></style>
        <script><?php include "database.js";?></script>
        <link rel="icon" type="image/x-icon" href="icon.jpg">
    </head>

    <body>
        <div class="pagebox">
            <b>Student Database</b><hr>
            Log in to access records.<br>

            <form id="webform" method="POST" action="login.php"> 
                <input class="textbar" name="username" type="text" 
                placeholder="User Name" oninput="toggleButtons(2);" 
                onkeydown="return (event.keyCode != 13);"><br>

                <input class="textbar" name="password" type="password" 
                placeholder="Password" oninput="toggleButtons(2);"
                onkeydown="return (event.keyCode != 13);"><br>

                <input id="Submit" type="button" value="Login" disabled
                onclick="checkInputs(toggleButtons(2))">
                <input id="Reset" type="button" value="Reset" disabled
                onclick="reset(); disableButtons();">
            </form>
        </div>
    </body>
</html>
