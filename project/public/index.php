<?php
// File: C:\xampp\htdocs\project\public\index.php

// 1. Nạp các file Core và Config
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/BaseController.php';

// 2. Nạp Model
require_once __DIR__ . '/../app/models/StudentModel.php';

// 3. Nạp Controller
require_once __DIR__ . '/../app/controllers/StudentController.php';

// 4. Lấy tham số từ URL (Routing đơn giản)
// Mặc định gọi StudentController và hàm index()
$controllerName = isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'StudentController';
$actionName = isset($_GET['a']) ? $_GET['a'] : 'index';

// 5. Khởi tạo Controller và chạy hàm tương ứng
if (class_exists($controllerName)) {
    $controller = new $controllerName();
    
    if (method_exists($controller, $actionName)) {
        $controller->$actionName();
    } else {
        echo "Lỗi: Không tìm thấy Action '$actionName' trong Controller này.";
    }
} else {
    echo "Lỗi: Không tìm thấy Controller '$controllerName'.";
}
?>