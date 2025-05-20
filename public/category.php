<?php
include '../config/database.php';
include '../src/controllers/CategoryController.php';

session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $controller = new CategoryController($pdo);
    $controller->showCategory($_GET['id']);
} else {
    echo "Невірний ID категорії.";
}

?>