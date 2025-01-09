<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Moodify</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Moodify</h1>

            <h1>Sign Up</h1>
        </header>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = htmlspecialchars(trim($_POST["username"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $pass = htmlspecialchars(trim($_POST["password"]));
    $confirm_pass = htmlspecialchars(trim($_POST["confirm_password"]));

    // Check for existing email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $count_mail = mysqli_num_rows($result);

    // Check for existing username
    $sql = "SELECT * FROM users WHERE name = '$user'";
    $result = mysqli_query($conn, $sql);
    $count_user = mysqli_num_rows($result);

    // Validation
    if (empty($user) || empty($email) || empty($pass) || empty($confirm_pass)) {
        echo '<script>alert("All fields are required.");</script>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email format.");</script>';
    } elseif ($pass !== $confirm_pass) {
        echo '<script>alert("Passwords do not match!");</script>';
    } elseif ($count_user > 0) {
        echo '<script>alert("Username already exists!");</script>';
    } elseif ($count_mail > 0) {
        echo '<script>alert("Email already exists!");</script>';
    } else {
        // Password hashing
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        // Insert new user
        $sql = "INSERT INTO users (name, email, password) VALUES ('$user', '$email', '$hash')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Start a session for the new user
            $_SESSION["username"] = $user; // Use $user from the form

            echo '<script>alert("Sign-up successful! Redirecting to dashboard...");</script>';
            header("Location: dashboard.php");
            exit();
        } else {
            echo '<script>alert("Error: Unable to sign up. Please try again.");</script>';
        }
    }
}
?>


</html>