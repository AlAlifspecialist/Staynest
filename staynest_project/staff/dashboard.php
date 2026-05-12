<?php
session_start();

if(!isset($_SESSION['UserID']) || $_SESSION['UserRole'] != "Staff"){
    header("Location: ../login.php");
    exit();
}
?>

<h1>Staff Dashboard</h1>
<p>Welcome Staff: <?php echo $_SESSION['Email']; ?></p>

<a href="bookings.php">Manage Bookings</a><br>
<a href="../logout.php">Logout</a>