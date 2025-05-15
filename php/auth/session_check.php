<?php
session_start();

if (!isset($_SESSION['id'])) {
    // Not logged in, redirect to login page
    header("Location: ../../html/login.html");
    exit();
}
