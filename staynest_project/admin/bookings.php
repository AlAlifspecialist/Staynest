<?php
include("../config/db.php");
session_start();

if(!isset($_SESSION['UserID']) || $_SESSION['UserRole'] != "Admin"){
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT bookings.*, users.Email, properties.PropertyTitle
        FROM bookings
        JOIN users ON bookings.UserID = users.UserID
        JOIN properties ON bookings.PropertyID = properties.PropertyID";

$result = $conn->query($sql);
?>

<h1>All Bookings</h1>

<table border="1" cellpadding="10">
<tr>
    <th>Booking ID</th>
    <th>User</th>
    <th>Property</th>
    <th>Check-in</th>
    <th>Check-out</th>
    <th>Status</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>
<tr>
    <td><?php echo $row['BookingID']; ?></td>
    <td><?php echo $row['Email']; ?></td>
    <td><?php echo $row['PropertyTitle']; ?></td>
    <td><?php echo $row['CheckInDate']; ?></td>
    <td><?php echo $row['CheckOutDate']; ?></td>
    <td><?php echo $row['BookingStatus'] ?? "Pending"; ?></td>
</tr>
<?php } ?>
</table>

<br>
<a href="dashboard.php">Back</a>