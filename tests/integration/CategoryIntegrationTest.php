<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Виправлено шлях

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/controllers/CategoryController.php';
require_once __DIR__ . '/../../src/controllers/UserController.php';

class CategoryIntegrationTest extends TestCase
{
    private $pdo;
    private $categoryController;
    private $userController;
    private $userId;

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

        $this->userController = new UserController($this->pdo);
        $this->categoryController = new CategoryController($this->pdo);

        // Створюємо користувача
        $this->userController->register('CatUser', 'catuser@example.com', 'pass123');
        $user = $this->pdo->query("SELECT * FROM users WHERE email='catuser@example.com'")->fetch(PDO::FETCH_ASSOC);
        $this->userId = $user['id'];
    }

    public function testCreateAndGetCategory()
    {
        $this->pdo->exec("INSERT INTO categories (name) VALUES ('IntegrationCat')");
        $categories = $this->categoryController->getCategoryModel()->getAllCategories();
        $this->assertNotEmpty($categories);
        $this->assertEquals('IntegrationCat', $categories[0]['name']);
    }
}
