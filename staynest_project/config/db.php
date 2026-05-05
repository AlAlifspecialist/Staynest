<?php
$conn = new mysqli("localhost", "root", "", "staynest");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>