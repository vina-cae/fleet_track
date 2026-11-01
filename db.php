<?php
// ==================== DATABASE CONNECTION ====================
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fleet_track";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>