<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
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
        .error {
            color: red;
        }
        a {
            color: #0056b3;
            text-decoration: none;
        }
    </style>
</head>
<body>


<div class="container">

    <div class="message-container">
        <h2>Register</h2>
        <form id="userForm">
            <label for="name">Name:</label><br>
            <input type="text" name="name" placeholder="Name" required><br><br>

            <label for="age">Age:</label><br>
            <input type="number" name="age" placeholder="Age" required><br><br>

            <label for="gender">Gender:</label><br>
            <select name="gender" required>
				<option value="">Select Gender</option>
				<option value="male">Male</option>
				<option value="female">Female</option>
				<option value="other">Other</option>
			</select><br><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" placeholder="Email" required><br><br>

            <label for="username">Username:</label><br>
            <input type="text" name="username" placeholder="Username" required><br><br>

            <button type="submit">Register</button>
        </form>

        <div id="registerMessage" class="error"></div>
    </div>


    <div class="message-container">
        <h2>Registered Users</h2>
        <div id="usernamesContainer">
        </div>
    </div>
</div>

<script>
    document.getElementById('userForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('submit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('registerMessage').innerHTML = data;
        fetchRegisteredUsers();
    })
    .catch(error => {
        console.error('Error:', error);
    });
});


function fetchRegisteredUsers() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_users.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('usernamesContainer').innerHTML = xhr.responseText;
        } else {
            document.getElementById('usernamesContainer').textContent = 'Could not fetch users';
        }
    };

    xhr.send();
}


fetchRegisteredUsers();
</script>

</body>
</html>
