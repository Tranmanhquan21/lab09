<?php
class BaseController {
    // Hàm hỗ trợ render view với layout
    protected function view($path, $data = []) {
        extract($data);
        // Render layout HTML + nội dung
        require __DIR__ . '/../views/layout.php';
    }
}