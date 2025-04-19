<?php
$host = "localhost";        // Hoặc 127.0.0.1
$user = "root";             // Mặc định của XAMPP là "root"
$password = "";             // Mặc định không có mật khẩu
$database = "tiembanh";      // Thay tên này thành tên database của bạn

// Kết nối
$conn = new mysqli($host, $user, $password, $database);

// Kiểm tra lỗi kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập utf8 để hiển thị tiếng Việt
$conn->set_charset("utf8");
