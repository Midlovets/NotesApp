<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/controllers/UserController.php';

$userController = new UserController($pdo);
$message = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Реєстрація користувача
    if (isset($_POST['register'])) {
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        
        // Перевірка заповненості полів
        if (empty($username) || empty($email) || empty($password)) {
            $message = 'Будь ласка, заповніть всі поля для реєстрації.';
        } else {
            $message = $userController->register($username, $email, $password);
            if (strpos($message, 'успішно') !== false) {
                header('Location: user.php'); 
                exit;
            }
        }

    // Логін користувача
    } else if (isset($_POST['login'])) {
        // Перевірка заповненості полів для входу
        if (empty($email) || empty($password)) {
            $message = 'Будь ласка, заповніть всі поля для входу.';
        } else {
            $message = $userController->login($email, $password);
            if (strpos($message, 'успішно') !== false) {
                header('Location: user.php');
                exit;
            }
        }
    }
}

include '../src/views/login.php';
?>
