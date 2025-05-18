<?php
//Error Message
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Connect DB
require_once('../config/dbconnect.php');

//Variables
$fullname = "";
$email = "";
$username = "";
$plainPassword = "";
$signUpError = "";

//Handle Post Request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Validate Inputs
    if (empty($_POST["username"])) {
        $signUpError = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
    }

    if (empty($_POST["name"])) {
        $signUpError = "Full name is required";
    } else {
        $fullname = test_input($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $signUpError = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $signUpError = "Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $signUpError = "Password is required";
    } else {
        $plainPassword = test_input($_POST["password"]);
    }

    if (empty($signUpError)) {
        // Hash the password securely
        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

        try {
            //Prepare and execute insert statement
            $stmt = $conn->prepare("INSERT INTO Users (Username, FullName, Email, PasswordHash) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $fullname, $email, $hashedPassword]);
            echo "User registered successfully!";
            header("Location: ../../html/login.html"); //Load Login Page
            exit();
        } catch (PDOException $e) {
            //Database Error
            $loginError = "Database error: " . $e->getMessage();
        }
    }
}

//Check Validation
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
