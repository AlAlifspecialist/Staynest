<?php
include("../config/db.php");
session_start();

if(!isset($_SESSION['UserID']) || $_SESSION['UserRole'] != "Host"){
    header("Location: ../login.php");
    exit();
}

$hostID = $_SESSION['UserID'];
$message = "";

if(isset($_POST['add'])){
    $title = $_POST['title'];
    $type = $_POST['type'];
    $address = $_POST['address'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $sql = "INSERT INTO properties (HostID, PropertyTitle, PropertyType, Address, PricePerMonth, AvailabilityStatus)
            VALUES ('$hostID', '$title', '$type', '$address', '$price', '$status')";

    if($conn->query($sql)){
        echo "<script>alert('Property added successfully.'); window.location.href='my_properties.php';</script>";
        exit();
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<h1>Add Property</h1>

<?php if($message != "") echo "<p style='color:red;'>$message</p>"; ?>

<form method="POST">
    <input type="text" name="title" placeholder="Property Title" required><br><br>
    <input type="text" name="type" placeholder="Property Type" required><br><br>
    <input type="text" name="address" placeholder="Address" required><br><br>
    <input type="number" name="price" placeholder="Price Per Month" required><br><br>

    <select name="status">
        <option value="Available">Available</option>
        <option value="Unavailable">Unavailable</option>
    </select><br><br>

    <button name="add">Add Property</button>
</form>

<br>
<a href="dashboard.php">Back</a>