<?php
include("../config/db.php");
session_start();

if(!isset($_SESSION['UserID']) || $_SESSION['UserRole'] != "Admin"){
    header("Location: ../login.php");
    exit();
}
?>

<h1>Admin Dashboard</h1>
<p>Welcome Admin: <?php echo $_SESSION['Email']; ?></p>

<a href="users.php">Manage Users</a><br>
<a href="bookings.php">View All Bookings</a><br>
<a href="../logout.php">Logout</a>