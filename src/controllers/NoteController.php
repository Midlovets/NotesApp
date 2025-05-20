<!-- // src/controllers/NoteController.php -->


<?php

include '../src/models/Note.php';
include '../src/models/Category.php';

class NoteController {
    private $noteModel;
    private $categoryModel;

    public function __construct($pdo) {
        $this->noteModel = new Note($pdo);
        $this->categoryModel = new Category($pdo);
    }

    public function showAllNotes($userId) {
        $notes = $this->noteModel->getAllNotesByUser($userId);
        // Добавляем теги к каждой нотатке
        foreach ($notes as &$note) {
            $note['tags'] = $this->noteModel->getTags($note['id']);
        }
        unset($note);
        $categories = $this->categoryModel->getAllCategories();
        include __DIR__ . '/../views/notes.php';
    }

    public function showCategory($categoryId) {
        $notes = $this->noteModel->getAllNotesByCategory($categoryId);
        foreach ($notes as &$note) {
            $note['tags'] = $this->noteModel->getTags($note['id']);
        }
        unset($note);
        include __DIR__ . '/../views/category.php';
    }

    public function showNote($noteId) {
        $note = $this->noteModel->getNoteById($noteId);
        $tags = $this->noteModel->getTags($noteId);
        $categories = $this->categoryModel->getAllCategories();
        $selectedCategoryId = $this->noteModel->getNoteCategoryId($noteId);
        include __DIR__ . '/../views/note.php';
    }

    public function searchNotes($keyword, $userId = null, $categoryId = null) {
        $results = $this->noteModel->searchNotes($keyword, $userId, $categoryId);
        $categories = $this->categoryModel->getAllCategories();
        include __DIR__ . '/../views/search.php';
    }

    public function saveNote($noteId, $userId, $title, $content, $tags = [], $categoryId = null) {
        // Обновить саму нотатку
        $this->noteModel->updateNote($noteId, $userId, $title, $content);

        // Обновить теги
        $this->noteModel->updateNoteTags($noteId, $tags);
        if ($categoryId) {
            $this->noteModel->updateNoteCategory($noteId, $categoryId);
        }
    }

    public function addNote($userId, $title, $content, $tags = [], $categoryId = null) {
        $noteId = $this->noteModel->createNote($userId, $title, $content);
        if ($categoryId) {
            $this->noteModel->updateNoteCategory($noteId, $categoryId);
        }
        if (!empty($tags)) {
            $this->noteModel->updateNoteTags($noteId, $tags);
        }
    }

    public function deleteNote($noteId, $userId) {
        $this->noteModel->deleteNote($noteId, $userId);
    }
}
?>
