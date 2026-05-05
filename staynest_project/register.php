<?php
include("config/db.php");

if(isset($_POST['register'])){
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

   $sql = "INSERT INTO users (FullName, Email, PasswordHash, PhoneNumber, IsActive)
        VALUES ('$fullName', '$email', '$password', '$phone', 1)";

    if($conn->query($sql)){
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Register</h2>

<form method="POST">
    <input type="text" name="full_name" placeholder="Full Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="text" name="phone" placeholder="Phone Number" required><br><br>

    <button name="register">Register</button>
</form>

<br>
<a href="login.php">Already have an account? Login</a>