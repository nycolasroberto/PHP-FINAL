<?php
class Comment {
    private $conn;
    private $table_name = "comments";

    public $id;
    public $content;
    public $post_id;
    public $user_id;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET content=:content, post_id=:post_id, user_id=:user_id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":post_id", $this->post_id);
        $stmt->bindParam(":user_id", $this->user_id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getByPostId($post_id) {
        $query = "SELECT c.*, u.name as author_name 
                 FROM " . $this->table_name . " c 
                 LEFT JOIN users u ON c.user_id = u.id 
                 WHERE c.post_id = :post_id 
                 ORDER BY c.created_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        return $stmt;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id AND user_id=:user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);
        
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT c.*, u.name as author_name, p.title as post_title 
                 FROM " . $this->table_name . " c 
                 LEFT JOIN users u ON c.user_id = u.id 
                 LEFT JOIN posts p ON c.post_id = p.id 
                 ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>