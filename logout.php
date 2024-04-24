<?php
session_start();
include 'include/config.php';


setcookie('rememberme', '', time() - 0 - 0 - 1, '/');
// Destroy the session
unset($_SESSION['usersid']);
unset($_SESSION['name']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['profile']);
unset($_SESSION['user_status']);
// Redirect to a logout confirmation page or any other page you prefer

header('location: login.php');

?>