<?php
$file = 'users.txt';


$existingUsers = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

if (!empty($existingUsers)) {
    foreach ($existingUsers as $user) {
        list($name, $age, $gender, $email, $username) = explode(',', $user);
        echo "<strong>Name:</strong> " . htmlspecialchars($name) . "<br>";
        echo "<strong>Age:</strong> " . htmlspecialchars($age) . "<br>";
        echo "<strong>Gender:</strong> " . htmlspecialchars($gender) . "<br>";
        echo "<strong>Email:</strong> " . htmlspecialchars($email) . "<br>";
        echo "<strong>Username:</strong> " . htmlspecialchars($username) . "<br><hr>";
    }
} else {
    echo 'No registered users yet.';
}
?>
