<?php
    session_start();
    if (!isset($_SESSION["status"])) {
        header("Location: login.php");
        exit;
    } elseif (isset($_POST["ID"])) {
        if ($_POST["ID"] === "") {
            echo '<script>
                window.alert("Error! The entry was not filled. Try again.");
            </script>';
        } else {
            // Store login parameters in variables
            $server = "spring-2024.cs.utexas.edu";
            $user = "cs329e_bulko_rktruong";
            $pwd = "Quiz_Rare6thigh";
            $dbName = "cs329e_bulko_rktruong";

            $mysqli = new mysqli ($server,$user,$pwd,$dbName);

            // If it returns a non-zero error number, print a
            // message and stop execution immediately
            if ($mysqli->connect_errno) {
                die('Connect Error: '.$mysqli->connect_errno.
                ": ". $mysqli->connect_error);
            }

            // Create the query as a string
            $command = "DELETE FROM STUDENTS WHERE ID = \"".$_POST["ID"]."\"";

            // Issue the query
            $result = $mysqli->query($command);

            // Verify the result
            // if (!$result) {
            //     die("Query failed: ($mysqli->error<br>SQL command = $command");
            // }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Student Records: Delete</title>
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
            Delete Student Record<br>
            <form id="webform" method="POST" action="delete.php"> 
                <input class="textbar" name="ID" type="text" 
                placeholder="Enter a valid ID" oninput="toggleButtons(1)" 
                onkeydown="return (event.keyCode != 13);"><br>
                
                <input id="Submit" type="button" value="Submit" disabled 
                onclick="checkInputs(toggleButtons(1))">
                <input id="Reset" type="button" value="Reset" disabled 
                onclick="reset(); disableButtons();">
            </form>
            <button class="optionbox" onclick='goToURL("actions.php")' 
            style="width:35%;">
                Back</button>
        </div>
    </body>
</html>
