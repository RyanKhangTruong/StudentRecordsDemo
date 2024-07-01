<?php
    session_start();
    if (!isset($_SESSION["status"])) {
        header("Location: login.php");
        exit;
    } elseif (isset($_POST["ID"], $_POST["LAST"], 
    $_POST["FIRST"], $_POST["MAJOR"], $_POST["GPA"])) {

        if (($_POST["ID"] === "") or ($_POST["LAST"] === "") or 
        ($_POST["FIRST"] === "") or ($_POST["MAJOR"] === "") or 
        ($_POST["GPA"] === "")) {
            echo '<script>
                window.alert("Error! Not all entries were filled. Try again.");
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
            $command = "INSERT INTO STUDENTS VALUES (".$_POST["ID"].
            ", \"".$_POST["LAST"]."\", \"".$_POST["FIRST"]."\", \"".
            $_POST["MAJOR"]."\", ".$_POST["GPA"].")";

            // Issue the query
            $result = $mysqli->query($command);
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Student Records: Insert</title>
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
            Insert Student Record<br>
            <form id="webform" method="POST" action="insert.php"> 
                <input class="textbar" name="ID" type="text" 
                placeholder="Enter ID" oninput="toggleButtons(5)" 
                onkeydown="return (event.keyCode != 13);"><br>
                <input class="textbar" name="LAST" type="text" 
                placeholder="Enter Last Name" oninput="toggleButtons(5)" 
                onkeydown="return (event.keyCode != 13);"><br>
                <input class="textbar" name="FIRST" type="text" 
                placeholder="Enter First Name" oninput="toggleButtons(5)" 
                onkeydown="return (event.keyCode != 13);"><br>
                <input class="textbar" name="MAJOR" type="text" 
                placeholder="Enter Major" oninput="toggleButtons(5)" 
                onkeydown="return (event.keyCode != 13);"><br>
                <input class="textbar" name="GPA" type="text" 
                placeholder="Enter GPA" oninput="toggleButtons(5)" 
                onkeydown="return (event.keyCode != 13);"><br>
                
                <input id="Submit" type="button" value="Submit" disabled 
                onclick="checkInputs(toggleButtons(5))">
                <input id="Reset" type="button" value="Reset" disabled 
                onclick="reset(); disableButtons();">
            </form>
            <button class="optionbox" onclick='goToURL("actions.php")' 
            style="width:35%;">
                Back</button>
        </div>
    </body>
</html>
