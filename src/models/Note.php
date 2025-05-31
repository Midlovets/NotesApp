<?php

class Note {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllNotesByCategory($categoryId) {
        $stmt = $this->pdo->prepare("
            SELECT n.* 
            FROM notes n
            JOIN note_categories nc ON n.id = nc.note_id
            WHERE nc.category_id = ?
            ORDER BY n.updated_at DESC, n.created_at DESC
        ");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNoteById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM notes WHERE id = ?");
        $stmt->execute([$id]);
        $note = $stmt->fetch(PDO::FETCH_ASSOC);
        return $note;
    }

    public function getTags($noteId) {
        $stmt = $this->pdo->prepare("
            SELECT t.id, t.name
            FROM tags t
            JOIN note_tags nt ON t.id = nt.tag_id
            WHERE nt.note_id = ?
        ");
        $stmt->execute([$noteId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchNotes($keyword, $userId = null, $categoryId = null) {
        $query = "
            SELECT DISTINCT n.*
            FROM notes n
            LEFT JOIN note_tags nt ON n.id = nt.note_id
            LEFT JOIN tags t ON nt.tag_id = t.id
        ";
        $where = [];
        $params = [];

        if ($categoryId) {
            $query .= " JOIN note_categories nc ON n.id = nc.note_id ";
            $where[] = "nc.category_id = ?";
            $params[] = $categoryId;
        }

        $where[] = "(n.title LIKE ? OR n.content LIKE ? OR t.name LIKE ?)";
        $params[] = '%' . $keyword . '%';
        $params[] = '%' . $keyword . '%';
        $params[] = '%' . $keyword . '%';

        if ($userId) {
            $where[] = "n.user_id = ?";
            $params[] = $userId;
        }

        if ($where) {
            $query .= " WHERE " . implode(' AND ', $where);
        }

        $query .= " ORDER BY n.updated_at DESC, n.created_at DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTags($userId) {
        $stmt = $this->pdo->prepare("
            SELECT DISTINCT t.id, t.name
            FROM tags t
            JOIN note_tags nt ON t.id = nt.tag_id
            JOIN notes n ON nt.note_id = n.id
            WHERE n.user_id = ?
            ORDER BY t.name
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllNotesByUser($userId) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM notes
            WHERE user_id = ?
            ORDER BY updated_at DESC, created_at DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateNote($noteId, $userId, $title, $content) {
        $stmt = $this->pdo->prepare("UPDATE notes SET title = ?, content = ?, updated_at = NOW() WHERE id = ? AND user_id = ?");
        $stmt->execute([$title, $content, $noteId, $userId]);
    }

    public function updateNoteTags($noteId, $tags) {
        $this->pdo->prepare("DELETE FROM note_tags WHERE note_id = ?")->execute([$noteId]);
        foreach ($tags as $tagName) {
            $tagName = trim($tagName);
            if ($tagName === '') continue;
            $stmt = $this->pdo->prepare("SELECT id FROM tags WHERE name = ?");
            $stmt->execute([$tagName]);
            $tagId = $stmt->fetchColumn();
            if (!$tagId) {
                $this->pdo->prepare("INSERT INTO tags (name) VALUES (?)")->execute([$tagName]);
                $tagId = $this->pdo->lastInsertId();
            }
            $this->pdo->prepare("INSERT IGNORE INTO note_tags (note_id, tag_id) VALUES (?, ?)")->execute([$noteId, $tagId]);
        }
    }

    public function getNoteCategoryId($noteId) {
        $stmt = $this->pdo->prepare("SELECT category_id FROM note_categories WHERE note_id = ?");
        $stmt->execute([$noteId]);
        return $stmt->fetchColumn();
    }

    public function updateNoteCategory($noteId, $categoryId) {
        $this->pdo->prepare("DELETE FROM note_categories WHERE note_id = ?")->execute([$noteId]);
        $this->pdo->prepare("INSERT INTO note_categories (note_id, category_id) VALUES (?, ?)")->execute([$noteId, $categoryId]);
    }

    public function deleteNote($noteId, $userId) {
        $stmt = $this->pdo->prepare("DELETE FROM notes WHERE id = ? AND user_id = ?");
        $stmt->execute([$noteId, $userId]);
    }

    public function createNote($userId, $title, $content) {
        $stmt = $this->pdo->prepare("INSERT INTO notes (user_id, title, content, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
        $stmt->execute([$userId, $title, $content]);
        return $this->pdo->lastInsertId();
    }
}
?>
