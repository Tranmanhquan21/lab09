HỆ THỐNG QUẢN LÝ SINH VIÊN (MVC + AJAX)
--------------------------------------------------
Họ và tên SV: Trần Mạnh Quân
Mã sinh viên: 202309496
Lớp/Học phần: IT3220 - Lập trình Web

--------------------------------------------------
1. YÊU CẦU HỆ THỐNG
--------------------------------------------------
- XAMPP (Apache + MySQL)
- PHP Version: 7.4 trở lên (Khuyến nghị 8.0+)
- Trình duyệt: Chrome hoặc Edge

--------------------------------------------------
2. HƯỚNG DẪN CÀI ĐẶT
--------------------------------------------------
Bước 1: Copy thư mục "project" vào thư mục htdocs của XAMPP.
        Đường dẫn chuẩn: C:\xampp\htdocs\project\

Bước 2: Cấu hình Cơ sở dữ liệu (Database)
        - Mở phpMyAdmin: http://localhost/phpmyadmin/
        - Tạo database mới tên là: it3220_php
        - Nhấn tab "Import", chọn file: project/database/it3220_php.sql
        - Nhấn "Go" (Thực hiện) để tạo bảng.

Bước 3: Kiểm tra cấu hình kết nối
        - Mở file: project/app/config/test_db.php
        - Đảm bảo thông tin đúng với máy của bạn (thường là user: root, pass: để trống).

--------------------------------------------------
3. CÁCH CHẠY CHƯƠNG TRÌNH
--------------------------------------------------
- Truy cập trình duyệt với đường dẫn sau:
  http://localhost/project/public/

--------------------------------------------------
4. CẤU TRÚC MÃ NGUỒN (MVC)
--------------------------------------------------
- app/models/      : Xử lý thao tác với Database (CRUD).
- app/views/       : Giao diện người dùng (HTML, không chứa SQL).
- app/controllers/ : Điều hướng và xử lý logic.
- public/assets/js : Chứa file app.js xử lý Ajax (không reload trang).