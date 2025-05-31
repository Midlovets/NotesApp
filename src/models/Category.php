<?php

class Category {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getCategoryById($categoryId) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$categoryId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCategories() {
        $stmt = $this->pdo->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNotesByCategory($categoryId) {
        $stmt = $this->pdo->prepare("
            SELECT n.* 
            FROM notes n
            JOIN note_categories nc ON n.id = nc.note_id
            WHERE nc.category_id = ?
        ");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function categoryExists($name) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM categories WHERE name = ?");
        $stmt->execute([$name]);
        return $stmt->fetchColumn() > 0;
    }
}
