<?php
session_start();

if(!isset($_SESSION['UserID'])){
    header("Location: login.php");
    exit();
}
?>

<h2>Welcome to StayNest</h2>

<p>You are logged in as: <?php echo $_SESSION['Email']; ?></p>

<a href="properties/list.php">View Properties</a><br>
<a href="bookings/mybookings.php">My Bookings</a><br>
<a href="logout.php">Logout</a>