<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../config.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Kiểm tra rỗng
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Vui lòng điền đầy đủ thông tin!";
    }
    // Kiểm tra xác nhận mật khẩu
    elseif ($password !== $confirm_password) {
        $error = "Mật khẩu xác nhận không khớp!";
    } else {
        // Kiểm tra email đã tồn tại
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email đã tồn tại!";
        } else {
            // Mã hóa mật khẩu và lưu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $name, $email, $hashed_password);

            if ($insert->execute()) {
                $success = "Đăng ký thành công! Bạn có thể đăng nhập.";
            } else {
                $error = "Đăng ký thất bại. Vui lòng thử lại.";
            }
        }
    }
}
?>

<?php include '../header.php'; ?>

<div class="container" style="max-width: 500px; margin-top: 30px;">
    <h2 class="text-center">Đăng Ký</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="form-group">
            <label>Họ tên:</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tên của bạn">
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Nhập email">
        </div>

        <div class="form-group">
            <label>Mật khẩu:</label>
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
        </div>

        <div class="form-group">
            <label>Nhập lại mật khẩu:</label>
            <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Đăng Ký</button>
    </form>

    <p class="text-center mt-3">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
</div>

<?php include '../footer.php'; ?>