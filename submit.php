<?php
$file = 'usernames.txt'; // File to store usernames

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    
    // Read existing usernames from the file
    $existingUsernames = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

    // Check if the username is empty
    if (empty($username)) {
        echo '<div class="error">Username cannot be empty!</div>';
    } 
    // Check if the username already exists in the file
    elseif (in_array(strtolower($username), array_map('strtolower', $existingUsernames))) {
        echo '<div class="exists">Username already exists!</div>';
    } 
    // Add new username to file and return success message
    else {
        // Append the new username to the file
        file_put_contents($file, $username . PHP_EOL, FILE_APPEND | LOCK_EX);
        echo '<div class="success">Registration successful!</div>';
    }
}
?>
