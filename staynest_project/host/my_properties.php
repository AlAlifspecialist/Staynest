<?php
include("../config/db.php");
session_start();

if(!isset($_SESSION['UserID']) || $_SESSION['UserRole'] != "Host"){
    header("Location: ../login.php");
    exit();
}

$hostID = $_SESSION['UserID'];

$result = $conn->query("SELECT * FROM properties WHERE HostID='$hostID'");
?>

<h1>My Properties</h1>

<?php while($row = $result->fetch_assoc()){ ?>
<div>
    <h3><?php echo $row['PropertyTitle']; ?></h3>
    <p>Type: <?php echo $row['PropertyType']; ?></p>
    <p>Address: <?php echo $row['Address']; ?></p>
    <p>Price: <?php echo $row['PricePerMonth']; ?> DKK</p>
    <p>Status: <?php echo $row['AvailabilityStatus']; ?></p>
</div>
<hr>
<?php } ?>

<a href="dashboard.php">Back</a>