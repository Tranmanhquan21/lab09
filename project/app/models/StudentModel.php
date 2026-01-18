<?php
require_once __DIR__ . '/../core/Database.php';

class StudentModel {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM students ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function checkExists($code, $email, $excludeId = null) {
        $sql = "SELECT count(*) FROM students WHERE (code = ? OR email = ?)";
        $params = [$code, $email];
        
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    public function create($data) {
        $sql = "INSERT INTO students (code, full_name, email, dob) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$data['code'], $data['full_name'], $data['email'], $data['dob']]);
    }

    public function update($id, $data) {
        $sql = "UPDATE students SET code = ?, full_name = ?, email = ?, dob = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$data['code'], $data['full_name'], $data['email'], $data['dob'], $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM students WHERE id = ?");
        return $stmt->execute([$id]);
    }
}