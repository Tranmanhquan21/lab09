CREATE DATABASE IF NOT EXISTS it3220_php;
USE it3220_php;

-- Các lệnh CREATE TABLE bên dưới giữ nguyên...

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    dob DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dữ liệu mẫu (Tối thiểu 5 bản ghi)
INSERT INTO students (code, full_name, email, dob) VALUES 
('SV001', 'Nguyen Van A', 'vana@example.com', '2000-01-01'),
('SV002', 'Tran Thi B', 'thib@example.com', '2001-05-15'),
('SV003', 'Le Van C', 'vanc@example.com', '2000-11-20'),
('SV004', 'Pham Thi D', 'thid@example.com', '2002-03-10'),
('SV005', 'Hoang Van E', 'vane@example.com', '2001-09-09');