<?php
session_start();

if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}
else
    echo ("chua dang nhap");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chính</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Xin chào, <?=$username; ?>!</h1>
        <div>
            <a href="view.php">Xem</a>
            <a href="edit.php">Chỉnh Sửa</a>
            <a href="search.php">Tìm Kiếm</a>
            <a href="admin_dashboard.php">Phân Quyền</a>
        </div>
        <a href="logout.php" class="logout">Đăng xuất</a>
    </div>
</body>
</html>
