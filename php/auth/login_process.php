<?php
//Error Message
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Connect DB
require_once('../config/dbconnect.php');

//Start Session
session_start();

//Variables
$username = "";
$password = "";
$loginError = "";

//Handle Post Requet
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Validate Inputs
    if (empty($_POST["username"])) {
        $loginError = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $loginError = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    // If inputs are valid, proceed to login
    if (empty($loginError)) {
        try {
            // Prepare SQL Query
            $stmt = $conn->prepare("SELECT * FROM Users WHERE Username = :username LIMIT 1");
            $stmt->bindParam(':username', $username); //Bind Variables
            $stmt->execute(); //Run

            $user = $stmt->fetch(PDO::FETCH_ASSOC); //Save Results to User Variable

            //check if user and decrption password match to form inputs
            if ($user && password_verify($password, $user['PasswordHash'])) {
                // Successful Login
                $_SESSION['username'] = $user['Username'];
                $_SESSION['id'] = $user['UserID'];
                echo ("Successfully Login");
                header("Location: ../customer/account_page.php"); //Load Page
            } else {
                //Failed Login
                echo ("Invalid username or password.");
            }
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
