<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/models/Note.php';

class NoteTest extends TestCase
{
    private $pdo;
    private $note;

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

        $this->pdo->exec("INSERT INTO users (id, name, email, password) VALUES (1, 'TestUser', 'test@example.com', 'pass')");
        $this->pdo->exec("INSERT INTO categories (name) VALUES ('TestCat')");
        $this->note = new Note($this->pdo);
    }

    public function testCreateAndGetNote()
    {
        $noteId = $this->note->createNote(1, 'Title', 'Content');
        $note = $this->note->getNoteById($noteId);
        $this->assertEquals('Title', $note['title']);
        $this->assertEquals('Content', $note['content']);
    }

    public function testUpdateNote()
    {
        $noteId = $this->note->createNote(1, 'Title', 'Content');
        $this->note->updateNote($noteId, 1, 'NewTitle', 'NewContent');
        $note = $this->note->getNoteById($noteId);
        $this->assertEquals('NewTitle', $note['title']);
        $this->assertEquals('NewContent', $note['content']);
    }

    public function testDeleteNote()
    {
        $noteId = $this->note->createNote(1, 'Title', 'Content');
        $this->note->deleteNote($noteId, 1);
        $note = $this->note->getNoteById($noteId);
        $this->assertFalse($note);
    }

    public function testUpdateNoteTags()
    {
        $noteId = $this->note->createNote(1, 'Title', 'Content');
        $this->note->updateNoteTags($noteId, ['php', 'test']);
        $tags = $this->note->getTags($noteId);
        $tagNames = array_column($tags, 'name');
        $this->assertContains('php', $tagNames);
        $this->assertContains('test', $tagNames);
    }
}
