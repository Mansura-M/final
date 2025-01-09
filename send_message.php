<?php
session_start();
require 'connect.php';

// Ensure the user is logged in through Moodify
if (!isset($_SESSION['id'])) {
    die("Access Denied. Please log in.");
}

$current_user_id = $_SESSION['id']; // Get logged-in user's ID

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = trim($_POST['message']);

    // Validate message
    if (strlen($message) > 0 && strlen($message) <= 500) {
        $stmt = $conn->prepare("INSERT INTO message (user_id, message, timestamp) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $current_user_id, $message);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Message is too long or empty."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
