<?php
include("../config/db.php");
session_start();

if(!isset($_SESSION['UserID'])){
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['UserID'];

$sql = "SELECT bookings.*, properties.PropertyTitle, properties.Address, properties.PricePerMonth
        FROM bookings
        JOIN properties ON bookings.PropertyID = properties.PropertyID
        WHERE bookings.UserID = '$userID'";

$result = $conn->query($sql);
?>

<h2>My Bookings</h2>

<?php
while($row = $result->fetch_assoc()){
    echo "<div>";
    echo "<h3>".$row['PropertyTitle']."</h3>";
    echo "<p>Address: ".$row['Address']."</p>";
    echo "<p>Check-in: ".$row['CheckInDate']."</p>";
    echo "<p>Check-out: ".$row['CheckOutDate']."</p>";
    echo "<p>Confirmed: ".$row['IsConfirmed']."</p>";
    echo "</div><hr>";
    echo "<a href='delete.php?id=".$row['BookingID']."'>Delete</a>";
    echo " | <a href='edit.php?id=".$row['BookingID']."'>Edit</a>";
}
?>

<a href="../dashboard.php">Back to Dashboard</a>