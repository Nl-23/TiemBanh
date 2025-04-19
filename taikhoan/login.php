<?php

session_start();
$error = '';
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Vui lòng nhập đầy đủ thông tin!";
    } else {
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $email
                ];
                header("Location: index.php");
                exit();
            } else {
                $error = "Sai mật khẩu!";
            }
        } else {
            $error = "Email không tồn tại!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><a href="../header.php">Đăng Nhập</a></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <?php include '../header.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h2 class="text-center">Đăng Nhập</h2>
                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label>Mật khẩu:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                </form>
                <p class="mt-3 text-center">Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>