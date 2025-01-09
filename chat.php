<?php
session_start();
if (!isset($_SESSION['id'])) {
    die("Access Denied. Please log in.");
}

include("connect.php");

// Get the logged-in user's ID from the session
$current_user_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Chatbot</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>

    <div class="chat-container">
        <div class="message-container" id="message-container"></div>

        <!-- Input Area -->
        <div class="chat-input">
            <input type="text" id="message" placeholder="Type a message...">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        // Pass the PHP value to JavaScript
        const YOUR_USER_ID = <?php echo $current_user_id; ?>;

        // Function to fetch messages
        function fetchMessages() {
            fetch('fetch_messages.php')
                .then(response => response.json())
                .then(data => {
                    let messageContainer = document.getElementById('message-container');
                    messageContainer.innerHTML = '';

                    data.reverse().forEach(msg => {
                        console.log("User ID:", msg.user_id);
                        let messageDiv = document.createElement('div');
                        messageDiv.classList.add('message');

                        if (parseInt(msg.user_id) === parseInt(YOUR_USER_ID)) {
                            messageDiv.classList.add('right');
                        } else {
                            messageDiv.classList.add('left');
                        }

                        messageDiv.innerHTML = `<p>${msg.message}</p>`;
                        messageContainer.appendChild(messageDiv);
                    });
                })
                .catch(err => console.error("Error fetching messages:", err));
        }

        // Function to send messages
        function sendMessage() {
            let messageInput = document.getElementById('message');
            let message = messageInput.value.trim();

            if (message !== '') {
                fetch('send_message.php', {
                        method: 'POST',
                        body: new URLSearchParams({
                            'message': message
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            fetchMessages(); // Fetch new messages
                        } else {
                            alert("Error sending message: " + data.message);
                        }
                    });

                messageInput.value = ''; // Clear input field
            }
        }

        // Fetch messages every 1 second
        setInterval(fetchMessages, 1000);
    </script>

</body>

</html>