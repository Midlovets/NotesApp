<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/models/User.php';

class UserTest extends TestCase
{
    private $pdo;
    private $user;

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

        $this->user = new User($this->pdo);
    }

    public function testRegisterSuccess()
    {
        $msg = $this->user->register('Test', 'test@example.com', 'pass123');
        $this->assertStringContainsString('успішна', $msg);
    }

    public function testRegisterDuplicate()
    {
        $this->user->register('Test', 'test@example.com', 'pass123');
        $msg = $this->user->register('Test', 'test@example.com', 'pass123');
        $this->assertStringContainsString('вже існує', $msg);
    }

    public function testLoginSuccess()
    {
        $this->user->register('Test', 'test@example.com', 'pass123');
        $result = $this->user->login('test@example.com', 'pass123');
        $this->assertIsArray($result);
        $this->assertEquals('Test', $result['name']);
    }

    public function testLoginFail()
    {
        $result = $this->user->login('notfound@example.com', 'pass123');
        $this->assertFalse($result);
    }

    public function testUpdateProfile()
    {
        $this->user->register('Test', 'test@example.com', 'pass123');
        $user = $this->user->login('test@example.com', 'pass123');
        $res = $this->user->updateProfile($user['id'], 'NewName');
        $this->assertTrue($res);
        $profile = $this->user->getProfile($user['id']);
        $this->assertEquals('NewName', $profile['name']);
    }

    public function testChangePassword()
    {
        $this->user->register('Test', 'test@example.com', 'pass123');
        $user = $this->user->login('test@example.com', 'pass123');
        $msg = $this->user->changePassword($user['id'], 'pass123', 'newpass');
        $this->assertStringContainsString('успішно', $msg);
        $result = $this->user->login('test@example.com', 'newpass');
        $this->assertIsArray($result);
    }

    public function testChangePasswordWrongCurrent()
    {
        $this->user->register('Test', 'test@example.com', 'pass123');
        $user = $this->user->login('test@example.com', 'pass123');
        $msg = $this->user->changePassword($user['id'], 'wrong', 'newpass');
        $this->assertStringContainsString('Неправильний', $msg);
    }
}
