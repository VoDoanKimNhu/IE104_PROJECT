<?php
    session_start();
    unset($_SESSION["accountid"]);
    // unset($_SESSION["name"]);
    header("location: #");
?>