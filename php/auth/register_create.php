<?php
//Error Message
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Connect DB
require_once('../config/dbconnect.php');

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input
    $user = trim($_POST['username']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $plainPassword = $_POST['password'];

    // Basic validation
    if (empty($user) || empty($name) || empty($email) || empty($plainPassword)) {
        die("All fields are required.");
    }

    // Hash the password securely
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    try {
        // Prepare and execute insert statement
        $stmt = $conn->prepare("INSERT INTO Users (Username, FullName, Email, PasswordHash) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user, $name, $email, $hashedPassword]);

        echo "User registered successfully!";
    } catch (PDOException $e) {
        // Handle duplicate entries or other DB issues gracefully
        if ($e->getCode() == 23000) {
            echo "Username or email already exists.";
        } else {
            echo "Database error: " . $e->getMessage();
        }
    }
} else {
    echo "Invalid request.";
}


