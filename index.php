<?php
// Check if the request is a POST (for API interaction)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents('php://input'));

    // Check if the 'name' is set in the request
    if (isset($data->name)) {
        // Prepare a personalized greeting message
        $response = [
            'message' => 'Hello, ' . htmlspecialchars($data->name) . '! Welcome to our business site.'
        ];
    } else {
        // Error if name is missing
        $response = [
            'message' => 'Error: Name is required to personalize the greeting.'
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
    <meta name="description" content="Welcome to our business. We provide top-notch services. Contact us to get started!">
    <title>Business SPA - Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Header */
        header {
            background-color: #1e3a8a;
            color: white;
            width: 100%;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 2.5rem;
            font-weight: 600;
        }

        header p {
            font-size: 1rem;
            margin-top: 10px;
        }

        /* Main Content Section */
        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 600px;
            width: 100%;
            padding: 40px;
            margin-top: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .content h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #1e3a8a;
            text-align: center;
        }

        .content input {
            width: 80%;
            max-width: 400px;
            padding: 15px;
            font-size: 1rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            outline: none;
            transition: border 0.3s ease;
        }

        .content input:focus {
            border: 2px solid #1e3a8a;
        }

        .content button {
            padding: 15px 25px;
            font-size: 1.1rem;
            color: white;
            background-color: #1e3a8a;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .content button:hover {
            background-color: #3b82f6;
        }

        .response {
            margin-top: 20px;
            font-weight: 600;
            font-size: 1.2rem;
            color: #333;
            display: none;
        }

        /* Footer */
        footer {
            background-color: #1e3a8a;
            color: white;
            width: 100%;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }

        footer p {
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }

            .content {
                padding: 20px;
            }

            .content h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Welcome to Our Business</h1>
        <p>Top-notch services at your fingertips. Let's connect!</p>
    </header>

    <!-- Main Content -->
    <div class="content">
        <h2>Get Your Personalized Greeting</h2>
        <input type="text" id="name" placeholder="Enter your name" />
        <button id="greetButton">Get Greeting</button>
        <div class="response" id="response"></div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2022 Business Name. All Rights Reserved.</p>
        <p><a href="https://www.vinzglobal.com" style="color: white; text-decoration: none;">Visit our website</a></p>
    </footer>

    <script>
        // Event listener for the button click
        document.getElementById('greetButton').addEventListener('click', function() {
            const name = document.getElementById('name').value;
            const responseDiv = document.getElementById('response');

            // Check if the name input is empty
            if (!name) {
                responseDiv.innerHTML = "Please enter your name!";
                responseDiv.style.color = "red";
                responseDiv.style.display = "block";
                return;
            }

            // Prepare the data to be sent
            const requestData = { name: name };

            // Send the request using Fetch API
            fetch('index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(requestData),
            })
            .then(response => response.json())
            .then(data => {
                // Display the greeting message
                responseDiv.innerHTML = data.message;
                responseDiv.style.color = "#1e3a8a";
                responseDiv.style.display = "block";
            })
            .catch(error => {
                // Handle any errors
                responseDiv.innerHTML = "An error occurred. Please try again later.";
                responseDiv.style.color = "red";
                responseDiv.style.display = "block";
            });
        });
    </script>

</body>
</html>
