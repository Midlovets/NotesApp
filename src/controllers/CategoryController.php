<?php

require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Note.php';

class CategoryController {
    private $categoryModel;
    private $noteModel;

    public function __construct($pdo) {
        $this->categoryModel = new Category($pdo);
        $this->noteModel = new Note($pdo);
    }

    public function showAllCategories() {
        $categories = $this->categoryModel->getAllCategories();
        include __DIR__ . '/../views/index.php';
    }

    public function showCategory($categoryId) {
        $category = $this->categoryModel->getCategoryById($categoryId);
        $categories = $this->categoryModel->getAllCategories();
        $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';

        if ($keyword !== '') {
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

    public function getCategoryModel() {
        return $this->categoryModel;
    }
}
