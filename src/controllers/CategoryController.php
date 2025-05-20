<?php

include '../src/models/Category.php';
include '../src/models/Note.php';

class CategoryController {
    private $categoryModel;
    private $noteModel;

    public function __construct($pdo) {
        $this->categoryModel = new Category($pdo);
        $this->noteModel = new Note($pdo);
    }

    // Отримує список усіх категорій для відображення на головній сторінці
    public function showAllCategories() {
        $categories = $this->categoryModel->getAllCategories();
        include __DIR__ . '/../views/index.php';
    }

    public function showCategory($categoryId) {
        $category = $this->categoryModel->getCategoryById($categoryId);
        $categories = $this->categoryModel->getAllCategories();
        $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';

        if ($keyword !== '') {
            // Поиск по ключевому слову только в рамках этой категории
            $notes = $this->noteModel->searchNotes($keyword, null, $categoryId);
        } else {
            $notes = $this->categoryModel->getNotesByCategory($categoryId);
        }

        foreach ($notes as &$note) {
            $note['tags'] = $this->noteModel->getTags($note['id']);
        }
        unset($note);

        include __DIR__ . '/../views/category.php';
    }
}
