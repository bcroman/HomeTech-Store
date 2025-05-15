<?php
require_once('../auth/session_check.php');
?>

<!-- <!DOCTYPE html> -->
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/style.css" />
  <title>HomeTech - Login</title>
</head>

<!-- Nav Bar -->
<nav class="navbar">
  <ul class="nav-links">
    <li><a href="../../index.html">Home</a></li>
    <li><a href="">Products</a></li>
    <li><a href="../customer/account_page.php">Account</a></li>
    <li><a href="">Basket</a></li>
  </ul>
</nav>

<!-- Content -->

<body>
  <h1>Account Dashboard</h1>

  <?php
  echo("Welcome, " . $_SESSION['username']);
  ?>

</body>

</html>