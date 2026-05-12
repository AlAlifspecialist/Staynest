<?php
include("config/db.php");
session_start();

$error = "";

if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE Email='$email'";
    $result = $conn->query($sql) or die($conn->error);

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();

        if(trim($user['PasswordHash']) == $password && $user['IsActive'] == 1){
            $_SESSION['UserID'] = $user['UserID'];
            $_SESSION['Email'] = $user['Email'];
            $_SESSION['UserRole'] = $user['UserRole'];

            if($user['UserRole'] == "Admin"){
                header("Location: admin/dashboard.php");
            } elseif($user['UserRole'] == "Staff"){
                header("Location: staff/dashboard.php");
            } elseif($user['UserRole'] == "Host"){
                header("Location: host/dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid password or inactive account.";
        }
    } else {
        $error = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>StayNest Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<nav>
    <h2>StayNest</h2>
    <ul>
        <li>HOME</li>
        <li>ABOUT</li>
        <li>SERVICE</li>
        <li>CONTACT</li>
        <li class="login-btn">LOGIN</li>
    </ul>
</nav>

<div class="login-box">
    <h1>LOGIN</h1>

    <?php if($error != "") echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <div class="input-box">
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" name="login">Login</button>

        <p class="register-text">
            Don’t have an Account?
            <a href="register.php">Register</a>
        </p>
    </form>
</div>

</body>
</html>