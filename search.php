<?php
session_start();

// Kiểm tra đăng nhập
// if (!isset($_SESSION['user'])) {
//     header("Location: login.php");
//     exit();
// }

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ct439";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Kiểm tra nếu có dữ liệu được gửi từ form tìm kiếm
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keyword = $_POST['keyword'];

    $sql = "SELECT * FROM thiet_bi WHERE ten_tb LIKE '%$keyword%' OR ghichu_tb LIKE '%$keyword%' OR id_tb LIKE '%$keyword%' OR dongia_tb LIKE '%$keyword%' OR sl_tb LIKE '%$keyword%' OR id_phong LIKE '%$keyword%'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Tìm Kiếm Thiết Bị</title>
</head>
<body>

    <div class="container">
        <h2>Tìm Kiếm Thiết Bị</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="keyword">Nhập từ khóa:</label>
            <input type="text" id="keyword" name="keyword" required>
            <input type="submit" value="Tìm Kiếm">
        </form>

        <?php
        if (isset($result)) {
            if ($result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>ID Thiết Bị</th>
                            <th>Tên Thiết Bị</th>
                            <th>Số Lượng</th>
                            <th>Đơn Giá</th>
                            <th>Ghi Chú</th>
                            <th>Phòng</th>
                        </tr>";

                // Hiển thị danh sách các thiết bị phù hợp với từ khóa
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_tb']}</td>
                            <td>{$row['ten_tb']}</td>
                            <td>{$row['sl_tb']}</td>
                            <td>{$row['dongia_tb']}</td>
                            <td>{$row['ghichu_tb']}</td>
                            <td>{$row['id_phong']}</td>
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "<p>Không có kết quả nào phù hợp.</p>";
            }
        }
        ?>

        <p><a href="main.php">Quay lại Trang Chính</a></p>
    </div>
</body>
</html>
