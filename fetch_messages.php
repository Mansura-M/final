<?php
session_start();
require 'connect.php';

// Query to fetch messages
$query = "SELECT user_id, message, timestamp FROM message ORDER BY timestamp DESC";
$result = $conn->query($query);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row; // Append each row to the messages array
}

echo json_encode($messages);
