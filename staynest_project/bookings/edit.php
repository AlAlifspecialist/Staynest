<?php
include("../config/db.php");

$id = $_GET['id'];

if(isset($_POST['update'])){
    if($checkIn >= $checkOut){
    die("Check-out date must be after check-in date.");
}
  

    $sql = "UPDATE bookings 
            SET CheckInDate='$checkIn', CheckOutDate='$checkOut'
            WHERE BookingID='$id'";

    if($conn->query($sql)){
        header("Location: mybookings.php");
    } else {
        echo "Error updating booking: " . $conn->error;
    }
}

$sql = "SELECT * FROM bookings WHERE BookingID='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<h2>Edit Booking</h2>

<form method="POST">
    <label>Check-in Date:</label>
    <input type="date" name="check_in" value="<?php echo $row['CheckInDate']; ?>" required><br><br>

    <label>Check-out Date:</label>
    <input type="date" name="check_out" value="<?php echo $row['CheckOutDate']; ?>" required><br><br>

    <button name="update">Update Booking</button>
</form>

<br>
<a href="mybookings.php">Back to My Bookings</a>