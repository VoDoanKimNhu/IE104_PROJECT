<?php
    error_reporting(0);
    session_start();
    unset($_SESSION["accountid"]);
    header("location: index.php");
?>