<?php
    session_start();
    session_destroy();
    echo '<link rel="icon" type="image/x-icon" href="icon.jpg">
    <script>
        window.alert("Thank you.");
        window.location.href = "login.php";
    </script>';
    exit;
