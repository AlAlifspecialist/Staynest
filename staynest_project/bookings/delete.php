
<?php
include("../config/db.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM bookings WHERE BookingID = '$id'";

    if($conn->query($sql)){
        header("Location: mybookings.php");
    } else {
        echo "Error deleting booking";
    }
}
?>