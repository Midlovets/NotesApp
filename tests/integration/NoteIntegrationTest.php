<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/controllers/NoteController.php';
require_once __DIR__ . '/../../src/controllers/UserController.php';
require_once __DIR__ . '/../../src/controllers/CategoryController.php';

class NoteIntegrationTest extends TestCase
{
    private $pdo;
    private $noteController;
    private $userController;
    private $categoryController;
    private $userId;
    private $categoryId;

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

        $this->userController = new UserController($this->pdo);
        $this->noteController = new NoteController($this->pdo);
        $this->categoryController = new CategoryController($this->pdo);

        // Створюємо користувача
        $this->userController->register('NoteUser', 'noteuser@example.com', 'pass123');
        $user = $this->pdo->query("SELECT * FROM users WHERE email='noteuser@example.com'")->fetch(PDO::FETCH_ASSOC);
        $this->userId = $user['id'];

        // Створюємо категорію
        $this->pdo->exec("INSERT INTO categories (name) VALUES ('TestCategory')");
        $this->categoryId = $this->pdo->lastInsertId();
    }

    public function testCreateAndGetNote()
    {
        $this->noteController->addNote($this->userId, 'Integration Note', 'Integration Content', ['tag1', 'tag2'], $this->categoryId);
        $notes = $this->noteController->getNoteModel()->getAllNotesByUser($this->userId);
        $this->assertCount(1, $notes);
        $this->assertEquals('Integration Note', $notes[0]['title']);
        $this->assertEquals('Integration Content', $notes[0]['content']);
        $this->assertEquals($this->userId, $notes[0]['user_id']);
    }

    public function testUpdateNote()
    {
        $this->noteController->addNote($this->userId, 'Old Title', 'Old Content', [], $this->categoryId);
        $note = $this->noteController->getNoteModel()->getAllNotesByUser($this->userId)[0];
        $this->noteController->saveNote($note['id'], $this->userId, 'New Title', 'New Content', ['newtag'], $this->categoryId);
        $updated = $this->noteController->getNoteModel()->getNoteById($note['id']);
        $this->assertEquals('New Title', $updated['title']);
        $this->assertEquals('New Content', $updated['content']);
    }

    public function testDeleteNote()
    {
        $this->noteController->addNote($this->userId, 'ToDelete', 'Content', [], $this->categoryId);
        $note = $this->noteController->getNoteModel()->getAllNotesByUser($this->userId)[0];
        $this->noteController->deleteNote($note['id'], $this->userId);
        $notes = $this->noteController->getNoteModel()->getAllNotesByUser($this->userId);
        $this->assertCount(0, $notes);
    }

    public function testSearchNote()
    {
        $this->noteController->addNote($this->userId, 'SearchTitle', 'SearchContent', ['searchtag'], $this->categoryId);
        $results = $this->noteController->getNoteModel()->searchNotes('SearchTitle', $this->userId, $this->categoryId);
        $this->assertNotEmpty($results);
        $this->assertEquals('SearchTitle', $results[0]['title']);
    }
}
