<?php
$file = 'users.txt';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['age'], $_POST['gender'], $_POST['email'], $_POST['username'])) {
    $name = trim($_POST['name']);
    $age = trim($_POST['age']);
    $gender = trim($_POST['gender']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    

    if (empty($name) || empty($age) || empty($gender) || empty($email) || empty($username)) {
        echo '<div class="error">All fields are required!</div>';
        exit;
    }


    $existingUsers = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    $existingUsernames = [];
    $existingEmails = [];
    $existingNames = [];

    foreach ($existingUsers as $user) {
        list($existingName, $existingAge, $existingGender, $existingEmail, $existingUsername) = explode(',', $user);
        $existingNames[] = strtolower($existingName);
        $existingEmails[] = strtolower($existingEmail);
        $existingUsernames[] = strtolower($existingUsername);
    }


    if (in_array(strtolower($name), $existingNames)) {
        echo '<div class="exists">Name already exists!</div>';
        exit;
    }


    if (in_array(strtolower($email), $existingEmails)) {
        echo '<div class="exists">Email already exists!</div>';
        exit;
    }


    if (in_array(strtolower($username), $existingUsernames)) {
        echo '<div class="exists">Username already exists!</div>';
    } else {
        
        $userData = implode(',', [$name, $age, $gender, $email, $username]);
        file_put_contents($file, $userData . PHP_EOL, FILE_APPEND | LOCK_EX);
        echo '<div class="success">Registration successful!</div>';
    }
} else {
    echo '<div class="error">Invalid request. Please submit the form.</div>';
}
?>
