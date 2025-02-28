<?php
// Check if the request is a POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents('php://input'));

    // Check if the name is set in the request
    if (isset($data->name)) {
        // Prepare a greeting message
        $response = [
            'message' => 'Hello, ' . htmlspecialchars($data->name) . '!'
        ];
    } else {
        // Error if name is missing
        $response = [
            'message' => 'Error: Name is required!'
        ];
    }

    // Return the response as JSON
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP SPA Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            text-align: center;
        }
        input {
            padding: 10px;
            margin-top: 20px;
            font-size: 16px;
        }
        button {
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
        }
        #response {
            margin-top: 30px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Welcome to the PHP SPA Example</h1>
    <input type="text" id="name" placeholder="Enter your name" />
    <button id="greetButton">Greet Me</button>
    
    <div id="response"></div>

    <script>
        document.getElementById('greetButton').addEventListener('click', function() {
            const name = document.getElementById('name').value;
            const responseDiv = document.getElementById('response');

            if (!name) {
                responseDiv.innerHTML = "Please enter your name.";
                return;
            }

            // Create the request payload
            const requestData = { name: name };

            // Send the POST request using Fetch API
            fetch('index.php', { // Send request to the same file (index.php)
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(requestData),
            })
            .then(response => response.json())
            .then(data => {
                // Display the server response
                responseDiv.innerHTML = data.message;
            })
            .catch(error => {
                // Handle errors
                responseDiv.innerHTML = "An error occurred. Please try again.";
            });
        });
    </script>
</body>
</html>
