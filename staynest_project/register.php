<?php
include("config/db.php");

$message = "";

if(isset($_POST['register'])){
    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);

    $check = "SELECT * FROM users WHERE Email='$email'";
    $result = $conn->query($check);

    if($result->num_rows > 0){
        $message = "Email already exists.";
    } else {
        $sql = "INSERT INTO users (FullName, Email, PasswordHash, PhoneNumber, IsActive, UserRole)
                VALUES ('$fullName', '$email', '$password', '$phone', 1, 'Customer')";

        if($conn->query($sql)){
            echo "<script>alert('Registration successful. Please login.'); window.location.href='login.php';</script>";
            exit();
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<h2>Register as Customer</h2>

<?php if($message != "") echo "<p style='color:red;'>$message</p>"; ?>

<form method="POST">
    <input type="text" name="full_name" placeholder="Full Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="text" name="phone" placeholder="Phone Number" required><br><br>
    <button name="register">Register</button>
</form>

<br>
<a href="login.php">Already have an account? Login</a>