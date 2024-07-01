<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Student Records: View</title>
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
            View Student Records<br>
            <table id="showtable">
                <tr>
                    <th>ID</th>
                    <th>Last</th>
                    <th>First</th>
                    <th>Major</th>
                    <th>GPA</th>
                </tr>
                <?php
                    session_start();
                    if (!isset($_SESSION["status"])) {
                        header("Location: login.php");
                        exit;
                    } elseif (isset($_POST["all"])) {
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
                        $command = 'SELECT * FROM STUDENTS ORDER BY LAST, FIRST';

			            // Issue the query 
                        $result = $mysqli->query($command);

                        // Verify the result
                        if (!$result) {
                            die("Query failed: ($mysqli->error 
                            <br> SQL command = $command");
                        }
                        
                        // Print rows
                        $noRows = true;
                        $row = $result->fetch_row();

                        while ($row) {
                            echo '<tr>
                                <td>'.$row[0].'</td>
                                <td>'.$row[1].'</td>
                                <td>'.$row[2].'</td>
                                <td>'.$row[3].'</td>
                                <td>'.$row[4].'</td>
                            </tr>';
                            $noRows = false;
                            $row = $result->fetch_row();
                        }

                        // Print nothing if nothing is returned
                        if ($noRows) {
                            echo '<tr>
                                <td colspan="5">No matches</td> 
                            </tr>';
                        }

                    } elseif (!isset($_POST["ID"]) and !isset($_POST["LAST"]) 
                    and !isset($_POST["FIRST"])) {
                        echo '<tr>
                        <td colspan="5">No matches</td> 
                        </tr>';
                    } elseif (($_POST["ID"] === "") and ($_POST["LAST"] === "") and ($_POST["FIRST"] === "")) {
                        echo '<script>
                            window.alert("Error! At least one entry must be filled! Try again.");
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
                        $command = 'SELECT * FROM STUDENTS WHERE ';

                        if ($_POST["ID"] !== "") {
                            $command .= 'ID = "'.$_POST["ID"].'" ';
                        } 
                        if ($_POST["LAST"] !== "") {
                            if ($_POST["ID"] !== "") {
                                $command .= 'AND LAST = "'.$_POST["LAST"].'" ';
                            } else {
                                $command .= 'LAST = "'.$_POST["LAST"].'" ';
                            }
                        }
                        if ($_POST["FIRST"] !== "") {
                            if (($_POST["ID"] !== "") or ($_POST["LAST"] !== "")) {
                                $command .= 'AND FIRST = "'.$_POST["FIRST"].'"';
                            } else {
                                $command .= 'FIRST = "'.$_POST["FIRST"].'"';
                            }
                        }
			
			            // Issue the query 
                        $result = $mysqli->query($command);

                        // Verify the result
                        if (!$result) {
                            die("Query failed: ($mysqli->error 
                            <br> SQL command = $command");
                        }
                        
                        // Print rows
                        $noRows = true;
                        $row = $result->fetch_row();

                        while ($row) {
                            echo '<tr>
                                <td>'.$row[0].'</td>
                                <td>'.$row[1].'</td>
                                <td>'.$row[2].'</td>
                                <td>'.$row[3].'</td>
                                <td>'.$row[4].'</td>
                            </tr>';
                            $noRows = false;
                            $row = $result->fetch_row();
                        }

                        // Print nothing if nothing is returned
                        if ($noRows) {
                            echo '<tr>
                                <td colspan="5">No matches</td> 
                            </tr>';
                        }
                    }
                ?>
            </table>
            <form id="webform" method="POST" action="view.php">
                <input class="textbar" name="ID" type="text" 
                placeholder="Enter ID" oninput="toggleButtons(1)" 
                onkeydown="return (event.keyCode != 13);"><br>
                <input class="textbar" name="LAST" type="text" 
                placeholder="Enter Last Name" oninput="toggleButtons(1)" 
                onkeydown="return (event.keyCode != 13);"><br>
                <input class="textbar" name="FIRST" type="text" 
                placeholder="Enter First Name" oninput="toggleButtons(1)" 
                onkeydown="return (event.keyCode != 13);"><br>
                
                <input id="Submit" type="button" value="Submit" disabled 
                onclick="checkInputs(toggleButtons(1))">
                <input id="Reset" type="button" value="Reset" disabled 
                onclick="reset(); disableButtons();">
                <input class="optionbox" type="submit" name="all"  
                value="View All Student Records"> 
            </form>
            <!--<button class="optionbox">View All Student Records</button><br>-->
            <button class="optionbox" onclick='goToURL("actions.php")' 
            style="width:35%;">
                Back</button>
        </div>
    </body>
</html>
