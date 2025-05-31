<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/models/Category.php';

class CategoryTest extends TestCase
{
    private $pdo;
    private $category;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=notesapp_test;charset=utf8', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec("SET FOREIGN_KEY_CHECKS=0");
        $this->pdo->exec("TRUNCATE TABLE note_categories");
        $this->pdo->exec("TRUNCATE TABLE categories");
        $this->pdo->exec("TRUNCATE TABLE notes");
        $this->pdo->exec("DELETE FROM users");
        $this->pdo->exec("SET FOREIGN_KEY_CHECKS=1");

        // Додаємо тестового користувача з id=1
        $this->pdo->exec("INSERT INTO users (id, name, email, password) VALUES (1, 'TestUser', 'test@example.com', 'pass')");
        $this->pdo->exec("INSERT INTO categories (name) VALUES ('TestCat')");
        $this->pdo->exec("INSERT INTO notes (user_id, title, content, created_at, updated_at) VALUES (1, 'Note', 'Content', NOW(), NOW())");
        $this->pdo->exec("INSERT INTO note_categories (note_id, category_id) VALUES (1, 1)");

        $this->category = new Category($this->pdo);
    }

    public function testGetCategoryById()
    {
        $cat = $this->category->getCategoryById(1);
        $this->assertEquals('TestCat', $cat['name']);
    }

    public function testGetAllCategories()
    {
        $cats = $this->category->getAllCategories();
        $this->assertCount(1, $cats);
        $this->assertEquals('TestCat', $cats[0]['name']);
    }

    public function testGetNotesByCategory()
    {
        $notes = $this->category->getNotesByCategory(1);
        $this->assertCount(1, $notes);
        $this->assertEquals('Note', $notes[0]['title']);
    }

    public function testCategoryExists()
    {
        $this->assertTrue($this->category->categoryExists('TestCat'));
        $this->assertFalse($this->category->categoryExists('NoCat'));
    }
}
