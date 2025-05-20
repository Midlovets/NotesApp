<?php
// filepath: e:\OSPanel\domains\NotesApp\public\details.php

session_start();
// Здесь можно добавить проверки авторизации, если нужно
// require_once __DIR__ . '/../config/database.php';
// require_once __DIR__ . '/../src/controllers/NotesController.php';

// $notesController = new NotesController($pdo);
// $notes = $notesController->getUserNotes($_SESSION['user_id']);

include __DIR__ . '/../src/views/details.php';