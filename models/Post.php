<?php
class Post {
    private $conn;
    private $table_name = "posts";

    public $id;
    public $title;
    public $content;
    public $category;
    public $user_id;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET title=:title, content=:content, category=:category, user_id=:user_id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":user_id", $this->user_id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll() {
        $query = "SELECT p.*, u.name as author_name 
                 FROM " . $this->table_name . " p 
                 LEFT JOIN users u ON p.user_id = u.id 
                 ORDER BY p.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById($id) {
        $query = "SELECT p.*, u.name as author_name 
                 FROM " . $this->table_name . " p 
                 LEFT JOIN users u ON p.user_id = u.id 
                 WHERE p.id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET title=:title, content=:content, category=:category 
                 WHERE id=:id AND user_id=:user_id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);
        
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id AND user_id=:user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);
        
        return $stmt->execute();
    }
}
?>