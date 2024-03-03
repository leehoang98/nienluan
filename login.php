<?php
session_start();

// Kiểm tra nếu đã đăng nhập, chuyển hướng đến trang chính
if (isset($_SESSION['user'])) {
    header('Location: main.php');
    exit();
}


// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ct439";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Mã hóa mật khẩu trước khi so sánh
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM user WHERE username = \"{$username}\"";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    if ($password == $row["password"]) {
        $_SESSION['username'] = $username;
        header('Location: main.php');
        exit();
    }
    else
        echo ("sai mat khau");
}



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Đăng nhập</h1>
        <?php if (isset($error)) : ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>
        <form method="post" action="login.php">
            <label for="username">Tên người dùng:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
</body>
</html>
