<?php
$servername = "localhost";
$username = "carritoe_root";
$password = "Eduardo25%";
$dbname = "carritoe_ave_archivos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>