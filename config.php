<?php

// Do NOT start session here; start it in your main scripts

// Error reporting for development (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DATABASE CONNECTION DETAILS
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbspay";

global $con;
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    die("Database connection failed: " . htmlspecialchars(mysqli_connect_error()));
}

