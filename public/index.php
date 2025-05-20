<?php
include '../config/database.php';

session_start(); 

if (isset($_POST['logout'])) {
    session_unset(); 
    session_destroy(); 
    header('Location: index.php'); 
    exit;
}

$isLoggedIn = isset($_SESSION['user_name']); 
$user_name = $isLoggedIn ? $_SESSION['user_name'] : 'Гість'; 

include '../src/views/index.php'; 
?>
