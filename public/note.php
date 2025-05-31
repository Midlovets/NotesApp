<?php
include '../config/database.php';
include '../src/controllers/NoteController.php'; 

// Исправлено: подключаем Category только если класс еще не объявлен
if (!class_exists('Category')) {
    include_once '../src/models/Category.php';
}

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
        if (!$noteId) {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $tags = [];
            if (isset($_POST['tags'])) {
                $tags = array_filter(array_map('trim', explode(',', $_POST['tags'])));
            }
            $categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : null;
            $controller->addNote($userId, $title, $content, $tags, $categoryId);
        } else {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $tags = [];
            if (isset($_POST['tags'])) {
                $tags = array_filter(array_map('trim', explode(',', $_POST['tags'])));
            }
            $categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : null;
            $controller->saveNote($noteId, $userId, $title, $content, $tags, $categoryId);
        }
        header('Location: notes.php');
        exit;
    }
    if (isset($_POST['delete'])) {
        $controller->deleteNote($noteId, $userId);
        if (isset($_GET['redirect']) && $_GET['redirect'] === 'category' && isset($_GET['id'])) {
            header('Location: category.php?id=' . intval($_GET['id']));
        } else {
            header('Location: notes.php');
        }
        exit;
    }
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $controller->showNote($_GET['id']);
} else {
    $note = [];
    $tags = [];
    $categories = (new Category($pdo))->getAllCategories();
    $selectedCategoryId = null;
    include __DIR__ . '/../src/views/note.php';
}
