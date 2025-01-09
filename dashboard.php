<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moodify Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="style.css">
</head>
<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
// Get the username from the session
$username = $_SESSION["username"];
$user_id = $_SESSION['id'];
?>


<body>
    <div class="dashboard-container">
        <!-- Logout Button -->
        <div style="position: absolute; top: 10px; right: 10px;">
            <form method="POST" action="logout.php">
                <button type="submit" class="btn btn-danger btn-sm" style="width: auto; padding: 5px 15px;">Logout</button>
            </form>
        </div>



        <header>
            <h1>Welcome, <?php echo " {$username}" ?></h1>
            <h4>How are you feeling today?</h4>
        </header>

        <div id="chartContainer">
            <canvas id="emotionChart"></canvas>
        </div>

        <div class="mood-input">
            <input type="text" id="textMood" placeholder="Enter your mood">
            <div> <button id="submitMood">Submit Mood</button>
                <button id="detectEmotion">Detect Emotion via Webcam</button>
                <button id="chatButton">Chat</button>
            </div>
        </div>

        <div class="options">
            <div class="option-card">
                <i class="fas fa-music"></i>
                <h3>Music Recommendations</h3>
            </div>

            <div class="option-card">
                <i class="fas fa-quote-left"></i>
                <h3>Motivational Quotes</h3>
            </div>

            <div class="option-card">
                <i class="fas fa-blog"></i>
                <h3>Read Blogs</h3>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script>
        document.getElementById("chatButton").addEventListener("click", function() {
            window.location.href = "chat.php"; // Replace with the actual path to your chatbot page
        });
    </script>

</body>

</html>