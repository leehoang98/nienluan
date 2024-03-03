<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ct439";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo("Kết nối không thành công: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <ul>
            <?php
            // Kiểm tra nếu có tham số phong_id được truyền từ URL
            if (isset($_GET['phong_id'])) {
                $phong_id = $_GET['phong_id'];

                // Truy vấn để lấy thông tin của các thiết bị trong phòng đó
                $sql = "SELECT id_tb, ten_tb FROM thiet_bi WHERE id_phong = \"{$phong_id}\"";
                $result = $conn->query($sql);

                // Hiển thị tên phòng
                echo "<h2>DANH SÁCH THIẾT BỊ</h2>";
                echo "<table border='1'>
                        <tr>
                            <th>ID Thiết Bị</th>
                            <th>Tên Thiết Bị</th>
                            <th>Xem Thêm</th>
                        </tr>";

                if ($result === false) {
                    die("Lỗi trong truy vấn SQL: " . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row["id_tb"]}</td>
                        <td>{$row["ten_tb"]}</td>
                        <td><a href='detail.php?id=" . $row['id_tb'] . "'>Chi tiết</a></td>
                    </tr>";
                }

                echo "</table>";

                echo "<p><a href='view.php'>Quay lại Danh Sách Phòng</a></p>";
            } elseif (isset($_GET['khoa_id'])) {
                $khoa_id = $_GET['khoa_id'];
                // Truy vấn để lấy danh sách các phòng thuộc khoa đó
                $sql = "SELECT * FROM phong WHERE id_khoa =\"{$khoa_id}\"";
                $result = $conn->query($sql);

                // Hiển thị tên khoa
                $khoa_result = $conn->query("SELECT * FROM phong");
                echo "<h2>DANH SÁCH PHÒNG</h2>";
                if($result -> num_rows > 0){
                    echo "<ul>";
                    while($row = $result -> fetch_assoc()){
                        echo "<li><a href='view.php?phong_id={$row["id_phong"]}'>{$row["ten_phong"]}</a></li>";
                    }
                    echo "</ul>";

                }
                echo "<p><a href='view.php'>Quay lại Danh Sách Khoa</a></p>";
            } else {
                // Truy vấn để lấy danh sách các khoa
                $sql = "SELECT * FROM khoa";
                $result = $conn->query($sql);

                echo "<h2>DANH SÁCH CÁC KHOA</h2>";

                echo "<ul>";
                // Hiển thị danh sách các khoa với liên kết đến các phòng
                while ($row = $result->fetch_assoc()) {
                    echo "<li><a href='view.php?khoa_id={$row['id_khoa']}'>{$row['ten_khoa']}</a></li>";
                }
                echo "</ul>";
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </ul>
        <a href="main.php">Quay lại Trang Chính</a>
    </div>
</body>
</html>
