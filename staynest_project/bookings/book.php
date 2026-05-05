<?php
include("../config/db.php");
session_start();

if (!isset($_GET['id'])) {
    die("No property selected.");
}

$propertyID = $_GET['id'];

if(isset($_POST['book'])){
    if(!isset($_SESSION['UserID'])){
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['UserID']; // temporary until login session is fully connected
    $bookingDate = date("Y-m-d");
    if($checkInDate >= $checkOutDate){
    die("Check-out date must be after check-in date.");
}


    $sql = "INSERT INTO bookings (UserID, PropertyID, BookingDate, CheckInDate, CheckOutDate, IsConfirmed)
            VALUES ('$userID', '$propertyID', '$bookingDate', '$checkInDate', '$checkOutDate', 1)";

    if($conn->query($sql)){
        echo "Booking successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Book Property</h2>

<form method="POST">
    <label>Check-in Date:</label>
    <input type="date" name="check_in" required><br><br>

    <label>Check-out Date:</label>
    <input type="date" name="check_out" required><br><br>

    <button name="book">Confirm Booking</button>
</form>

<br>
<a href="../properties/list.php">Back to Properties</a>