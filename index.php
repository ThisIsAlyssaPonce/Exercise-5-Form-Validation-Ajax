<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation with AJAX</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .message-container {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            flex-grow: 1;
        }
        .success {
            background-color: #e7f3fe;
            color: #31708f;
            border: 1px solid #bce8f1;
        }
        .exists {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
        a {
            color: #0056b3;
            text-decoration: none;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Register Message Container -->
    <div class="message-container">
        <h2>Register</h2>
        <form id="userForm">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br><br>
            <input type="submit" value="Submit">
        </form>

        <div id="registerMessage" class="error"></div>
    </div>

    <!-- Current Usernames Message Container -->
    <div class="message-container">
        <h2>Current Usernames</h2>
        <div id="usernamesContainer">
            <!-- Fetched usernames will appear here -->
        </div>
    </div>
</div>

<script>
    document.getElementById('userForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const username = document.getElementById('username').value;
        const registerMessageDiv = document.getElementById('registerMessage');

        // Clear previous messages
        registerMessageDiv.textContent = '';

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'submit.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status === 200) {
                registerMessageDiv.innerHTML = xhr.responseText;
                // Reload the usernames after form submission
                fetchUsernames();
            } else {
                registerMessageDiv.textContent = 'An error occurred';
            }
        };

        xhr.send('username=' + encodeURIComponent(username));
    });

    // Function to fetch and display usernames
    function fetchUsernames() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_usernames.php', true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('usernamesContainer').innerHTML = xhr.responseText;
            } else {
                document.getElementById('usernamesContainer').textContent = 'Could not fetch usernames';
            }
        };

        xhr.send();
    }

    // Fetch usernames on page load
    fetchUsernames();
</script>

</body>
</html>
