<?php

// Check POST request 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Read main1.json and get the content
    $data = file_get_contents('main1.json');
    $users = json_decode($data, true);

    // Control users
    foreach ($users as $user) {
        // If username and password match
        if ($user['username'] === $username && $user['password'] === $password) {
            // User redirect
            if ($username == 'admin') {
                header("Location: adminindex.php");
                exit();
            } elseif ($username == 'user') {
                header("Location: userindex.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        }
    }
    // If there is no match, redirect back to the login page
    header("Location: index.php");
    exit();
}

