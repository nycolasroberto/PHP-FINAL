<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $name;
    public $email;
    public $password;
    public $cpf;
    public $birth_date;
    public $role;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET name=:name, email=:email, password=:password, cpf=:cpf, birth_date=:birth_date";
        
        $stmt = $this->conn->prepare($query);
        
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":birth_date", $this->birth_date);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login($email, $password) {
        $query = "SELECT id, name, email, password, role FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->email = $row['email'];
                $this->role = $row['role'];
                return true;
            }
        }
        return false;
    }

    public function validateRecovery($email, $cpf, $birth_date) {
        $query = "SELECT id FROM " . $this->table_name . " 
                 WHERE email = :email AND cpf = :cpf AND birth_date = :birth_date LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':birth_date', $birth_date);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    public function updatePassword($email, $new_password) {
        $query = "UPDATE " . $this->table_name . " SET password = :password WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        
        return $stmt->execute();
    }

    public function emailExists($email) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>