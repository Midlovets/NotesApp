<?php
include '../config/database.php';
include '../src/controllers/NoteController.php'; 

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$controller = new NoteController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $noteId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $userId = $_SESSION['user_id'];
    if (isset($_POST['save'])) {
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $tags = [];
        if (isset($_POST['tags'])) {
            // Ожидається строка тегів через запяту
            $tags = array_filter(array_map('trim', explode(',', $_POST['tags'])));
        }
        $categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : null;
        $controller->saveNote($noteId, $userId, $title, $content, $tags, $categoryId);
        header('Location: notes.php');
        exit;
    }
    if (isset($_POST['delete'])) {
        $controller->deleteNote($noteId, $userId);
        header('Location: notes.php');
        exit;
    }
}

// Перевіряємо, чи передано параметр ID нотатки
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $controller->showNote($_GET['id']);
} else {
    echo "Невірний ID нотатки.";
}
