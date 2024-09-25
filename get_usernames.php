<?php
$file = 'usernames.txt'; // File to store usernames

// Read existing usernames from the file
$existingUsernames = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

if (!empty($existingUsernames)) {
    foreach ($existingUsernames as $user) {
        echo htmlspecialchars($user) . '<br>';
    }
} else {
    echo 'No usernames yet.';
}
?>
