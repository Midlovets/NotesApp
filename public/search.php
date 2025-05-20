<?php
include '../config/database.php';
include '../src/controllers/NoteController.php';

session_start();

$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
$categoryId = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

$noteController = new NoteController($pdo);
$noteController->searchNotes($keyword, $_SESSION['user_id'] ?? null, $categoryId);
