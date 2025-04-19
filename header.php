<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Bán Bánh</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="img/1.webp" alt="Logo" style="height: 40px;"> Hành Tinh Bánh
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Trang Chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">Sản Phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Giới Thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Liên Hệ</a></li>
                </ul>

                <!-- Form tìm kiếm -->
                <form class="d-flex" action="search.php" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm bánh..." name="query">
                    <button class="btn btn-outline-light" type="submit">Tìm</button>
                </form>

                <!-- Tài khoản người dùng -->
                <ul class="navbar-nav ms-3">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user']['name']; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="profile.php">Tài Khoản</a></li>
                                <li><a class="dropdown-item" href="orders.php">Đơn Hàng</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Đăng Xuất</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item"><a class="nav-link" href="./taikhoan/login.php">Đăng Nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="./taikhoan/register.php">Đăng Ký</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>