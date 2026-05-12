<?php
include("../config/db.php");
session_start();

if(!isset($_SESSION['UserID']) || $_SESSION['UserRole'] != "Staff"){
    header("Location: ../login.php");
    exit();
}

if(isset($_GET['confirm'])){
    $id = $_GET['confirm'];
    $conn->query("UPDATE bookings SET BookingStatus='Confirmed', IsConfirmed=1 WHERE BookingID='$id'");
}

if(isset($_GET['cancel'])){
    $id = $_GET['cancel'];
    $conn->query("UPDATE bookings SET BookingStatus='Cancelled', IsConfirmed=0 WHERE BookingID='$id'");
}

$sql = "SELECT bookings.*, users.Email, properties.PropertyTitle
        FROM bookings
        JOIN users ON bookings.UserID = users.UserID
        JOIN properties ON bookings.PropertyID = properties.PropertyID";

$result = $conn->query($sql);
?>

<h1>Staff Booking Management</h1>

<table border="1" cellpadding="10">
<tr>
    <th>User</th>
    <th>Property</th>
    <th>Check-in</th>
    <th>Check-out</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>
<tr>
    <td><?php echo $row['Email']; ?></td>
    <td><?php echo $row['PropertyTitle']; ?></td>
    <td><?php echo $row['CheckInDate']; ?></td>
    <td><?php echo $row['CheckOutDate']; ?></td>
    <td><?php echo $row['BookingStatus'] ?? "Pending"; ?></td>
    <td>
        <a href="bookings.php?confirm=<?php echo $row['BookingID']; ?>">Confirm</a> |
        <a href="bookings.php?cancel=<?php echo $row['BookingID']; ?>">Cancel</a>
    </td>
</tr>
<?php } ?>
</table>

<br>
<a href="dashboard.php">Back</a>