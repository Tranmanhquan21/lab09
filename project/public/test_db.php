<?php
require_once __DIR__ . '/../app/core/Database.php';

try {
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->query("SELECT COUNT(*) as total FROM students");
    $result = $stmt->fetch();
    echo "<h1>Kết nối thành công!</h1>";
    echo "Tổng số sinh viên: " . $result['total'];
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}