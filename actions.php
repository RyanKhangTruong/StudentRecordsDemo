<?php
    session_start();
    if (!isset($_SESSION["status"])) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Student Records: Actions</title>
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
            Actions<br>
            <button class="optionbox" onclick='goToURL("insert.php")'>
                Insert Student Record</button><br>
            <button class="optionbox" onclick='goToURL("update.php")'>
                Update Student Record</button><br>
            <button class="optionbox" onclick='goToURL("delete.php")'>
                Delete Student Record</button><br>
            <button class="optionbox" onclick='goToURL("view.php")'>
                View Student Record</button><br>
            <button class="optionbox" onclick='goToURL("logout.php")' 
            style="width:35%;">
                Logout</button>
        </div>
    </body>
</html>
