<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/controllers/UserController.php';

class UserIntegrationTest extends TestCase
{
    private $pdo;
    private $controller;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=notesapp_test;charset=utf8', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec("SET FOREIGN_KEY_CHECKS=0");
        $this->pdo->exec("TRUNCATE TABLE note_tags");
        $this->pdo->exec("TRUNCATE TABLE note_categories");
        $this->pdo->exec("TRUNCATE TABLE tags");
        $this->pdo->exec("TRUNCATE TABLE notes");
        $this->pdo->exec("TRUNCATE TABLE categories");
        $this->pdo->exec("DELETE FROM users");
        $this->pdo->exec("SET FOREIGN_KEY_CHECKS=1");

        $this->controller = new UserController($this->pdo);
    }

    public function testRegisterAndLogin()
    {
        $registerMsg = $this->controller->register('IntegrationUser', 'integration@example.com', 'pass123');
        $this->assertStringContainsString('успішна', $registerMsg);

        $loginMsg = $this->controller->login('integration@example.com', 'pass123');
        $this->assertStringContainsString('успішно', $loginMsg);
    }

    public function testRegisterDuplicateEmail()
    {
        $this->controller->register('IntegrationUser', 'integration@example.com', 'pass123');
        $msg = $this->controller->register('IntegrationUser', 'integration@example.com', 'pass123');
        $this->assertStringContainsString('вже існує', $msg);
    }

    public function testUpdateProfile()
    {
        $this->controller->register('IntegrationUser', 'integration@example.com', 'pass123');
        $user = $this->pdo->query("SELECT * FROM users WHERE email='integration@example.com'")->fetch(PDO::FETCH_ASSOC);
        $msg = $this->controller->updateUserProfile($user['id'], 'NewIntegrationName');
        $this->assertStringContainsString('успішно', $msg);
    }
}
