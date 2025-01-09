<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Moodify</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Moodify</h1>
            <p>Your Personalized Emotional Companion</p>
        </header>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</body>
<?php
session_start(); // Start the session
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = htmlspecialchars(trim($_POST["username"]));
    $pass = htmlspecialchars(trim($_POST["password"]));

    // Check if the username or password is empty
    if (empty($user) || empty($pass)) {
        echo '<script>alert("All fields are required.");</script>';
    } else {
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->bind_param("s", $user); // Bind the username to the prepared statement

        // Execute the prepared statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Fetch user data
            $hashed_password = $row["password"]; // Get the hashed password

            // Verify the entered password with the hashed password
            if (password_verify($pass, $hashed_password)) {
                // Store the username in a session
                $_SESSION["username"] = $row["name"];
                $_SESSION['id'] = $row['id'];
                header("Location: dashboard.php"); // Redirect to the dashboard
                exit(); // Ensure no further script execution
            } else {
                echo '<script>alert("Wrong password!");</script>';
            }
        } else {
            echo '<script>alert("Login failed. Invalid username or password!");</script>';
        }

        // Close the statement
        $stmt->close();
    }
}
?>


</html>