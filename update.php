<?php
    session_start();
    if (!isset($_SESSION["status"])) {
        header("Location: login.php");
        exit;
    } elseif (isset($_POST["ID"], $_POST["LAST"], 
    $_POST["FIRST"], $_POST["MAJOR"], $_POST["GPA"])) {

        if (($_POST["ID"] === "") or (($_POST["LAST"] === "") and 
        ($_POST["FIRST"] === "") and ($_POST["MAJOR"] === "") and 
        ($_POST["GPA"] === ""))) {
            echo '<script>
                window.alert("Error! ID or the other entries were not filled. 
                Try again.");
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

            // Create queries as strings and issue them
            if ($_POST["LAST"] !== "") {
                $command = "UPDATE STUDENTS SET LAST = \"".$_POST["LAST"].
                "\" WHERE ID =\"".$_POST["ID"]."\"";
                $result = $mysqli->query($command);
            }
            if ($_POST["FIRST"] !== "") {
                $command = "UPDATE STUDENTS SET FIRST = \"".$_POST["FIRST"].
                "\" WHERE ID =\"".$_POST["ID"]."\"";
                $result = $mysqli->query($command);
            }
            if ($_POST["MAJOR"] !== "") {
                $command = "UPDATE STUDENTS SET MAJOR = \"".$_POST["MAJOR"].
                "\" WHERE ID =\"".$_POST["ID"]."\"";
                $result = $mysqli->query($command);
            }
            if ($_POST["GPA"] !== "") {
                $command = "UPDATE STUDENTS SET GPA = \"".$_POST["GPA"].
                "\" WHERE ID =\"".$_POST["ID"]."\"";
                $result = $mysqli->query($command);
            } 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Student Records: Update</title>
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
            Update Student Record<br>
            <form id="webform" method="POST" action="update.php"> 
                <input class="textbar" name="ID" type="text" 
                placeholder="Enter ID" oninput="enableButtons(2)"
                onkeydown="return (event.keyCode != 13);"><br>
                <input class="textbar" name="LAST" type="text" 
                placeholder="Enter Last Name" oninput="enableButtons(2)"
                onkeydown="return (event.keyCode != 13);"><br>
                <input class="textbar" name="FIRST" type="text" 
                placeholder="Enter First Name" oninput="enableButtons(2)"
                onkeydown="return (event.keyCode != 13);"><br>
                <input class="textbar" name="MAJOR" type="text" 
                placeholder="Enter Major" oninput="enableButtons(2)"
                onkeydown="return (event.keyCode != 13);"><br>
                <input class="textbar" name="GPA" type="text" 
                placeholder="Enter GPA" oninput="enableButtons(2)"
                onkeydown="return (event.keyCode != 13);"><br>
                
                <input id="Submit" type="button" value="Submit" disabled 
                onclick="checkInputs(enableButtons(2))">
                <input id="Reset" type="button" value="Reset" disabled  
                onclick="reset(); disableButtons();">
            </form>
            <button class="optionbox" onclick='goToURL("actions.php")' 
            style="width:35%;">
                Back</button>
        </div>
    </body>
</html>
