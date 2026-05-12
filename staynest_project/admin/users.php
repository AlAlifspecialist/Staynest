<?php
include("../config/db.php");
session_start();

if(!isset($_SESSION['UserID']) || $_SESSION['UserRole'] != "Admin"){
    header("Location: ../login.php");
    exit();
}

$result = $conn->query("SELECT * FROM users");
?>

<h1>Manage Users</h1>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Status</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>
<tr>
    <td><?php echo $row['UserID']; ?></td>
    <td><?php echo $row['FullName']; ?></td>
    <td><?php echo $row['Email']; ?></td>
    <td><?php echo $row['UserRole']; ?></td>
    <td><?php echo $row['IsActive'] == 1 ? "Active" : "Inactive"; ?></td>
</tr>
<?php } ?>
</table>

<br>
<a href="dashboard.php">Back</a>