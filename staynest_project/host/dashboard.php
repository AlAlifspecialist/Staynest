<?php
session_start();

if(!isset($_SESSION['UserID']) || $_SESSION['UserRole'] != "Host"){
    header("Location: ../login.php");
    exit();
}
?>

<h1>Host Dashboard</h1>
<p>Welcome Host: <?php echo $_SESSION['Email']; ?></p>

<a href="add_property.php">Add Property</a><br>
<a href="my_properties.php">My Properties</a><br>
<a href="../logout.php">Logout</a>