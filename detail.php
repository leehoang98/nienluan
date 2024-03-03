
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin thiết bị</title>
</head>
<body>
    <h1>Thông tin thiết bị</h1>
    <?php
    if(isset($_GET['id'])) {
        // Lấy id_tb từ URL và làm sạch nó
        $id_tb = $_GET['id'];
        
        // Kết nối đến cơ sở dữ liệu
        $conn = new mysqli('localhost', 'root', '', 'ct439');
        
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối không thành công: " . $conn->connect_error);
        }

        // Truy vấn thông tin chi tiết của thiết bị
        $sql = "SELECT * FROM thiet_bi WHERE id_tb = '$id_tb'";
        $result = $conn->query($sql);

        // Hiển thị thông tin chi tiết
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<p><strong>ID:</strong> " . $row["id_tb"] . "</p>";
            echo "<p><strong>Tên thiết bị:</strong> " . $row["ten_tb"] . "</p>";
            echo "<p><strong>ID Phòng:</strong> " . $row["id_phong"] . "</p>";
            // echo "<p><strong>Cấu hình:</strong> " . $row["cauhinh_tb"] . "</p>";
            echo "<p><strong>Số lượng:</strong> " . $row["sl_tb"] . "</p>";
            echo "<p><strong>Đơn giá:</strong> " . $row["dongia_tb"] . "</p>";
            echo "<p><strong>Ghi chú:</strong> " . $row["ghichu_tb"] . "</p>";
        } else {
            echo "Không tìm thấy thông tin cho thiết bị này";
        }
        $conn->close();
    } else {
        echo "Thiếu thông tin về thiết bị";
    }

    ?>
</body>
</html>
