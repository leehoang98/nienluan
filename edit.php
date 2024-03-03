<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ct439";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

//Thêm thiết bị
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $id_tb = $_POST['id_tb'];
    $ten_tb = $_POST['ten_tb'];
    $id_phong = $_POST['id_phong'];
    $sl_tb = $_POST['sl_tb'];
    $dongia_tb = $_POST['dongia_tb'];
    $ghichu_tb = $_POST['ghichu_tb'];

    $sql = "INSERT INTO thiet_bi (id_tb, ten_tb, id_phong, sl_tb, dongia_tb, ghichu_tb) 
            VALUES ('$id_tb', '$ten_tb', '$id_phong', '$sl_tb', '$dongia_tb', '$ghichu_tb')";
    $conn->query($sql);
}

//Sửa thiết bị
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $id_tb_edit = $_POST['id_tb_edit'];
    $ten_tb_edit = $_POST['ten_tb_edit'];
    $id_phong_edit = $_POST['id_phong_edit'];
    $sl_tb_edit = $_POST['sl_tb_edit'];
    $dongia_tb_edit = $_POST['dongia_tb_edit'];
    $ghichu_tb_edit = $_POST['ghichu_tb_edit'];

    $sql = "UPDATE thiet_bi 
            SET ten_tb = '$ten_tb_edit', id_phong = '$id_phong_edit', sl_tb = '$sl_tb_edit', 
                dongia_tb = '$dongia_tb_edit', ghichu_tb = '$ghichu_tb_edit' 
            WHERE id_tb = '$id_tb_edit'";
    $conn->query($sql);
}

// Chức năng Xóa
if (isset($_GET['delete'])) {
    $id_tb_delete = $_GET['delete'];

    $sql = "DELETE FROM thiet_bi WHERE id_tb = '$id_tb_delete'";
    $conn->query($sql);
}

$sql_select_all = "SELECT * FROM thiet_bi";
$result_all = $conn->query($sql_select_all);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Chỉnh Sửa Thiết Bị</title>
</head>
<body>

<div class="container">
<h2>CHỈNH SỬA THIẾT BỊ</h2>


<!-- Form Thêm Thiết Bị -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h3>THÊM THIẾT BỊ</h3>
    <label for="id_tb">ID Thiết Bị:</label>
    <input type="text" id="id_tb" name="id_tb" required>

    <label for="ten_tb">Tên Thiết Bị:</label>
    <input type="text" id="ten_tb" name="ten_tb" required>

    <label for="id_phong">ID Phòng:</label>
    <input type="text" id="id_phong" name="id_phong" required>

    <label for="sl_tb">Số Lượng:</label>
    <input type="text" id="sl_tb" name="sl_tb" required>

    <label for="dongia_tb">Đơn Giá:</label>
    <input type="text" id="dongia_tb" name="dongia_tb" required>

    <label for="ghichu_tb">Ghi Chú:</label>
    <input type="text" id="ghichu_tb" name="ghichu_tb">

    <input type="submit" name="add" value="Thêm">
</form>

<hr>

<!-- Form Sửa Thiết Bị -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h3>SỬA THIẾT BỊ</h3>
    <label for="id_tb_edit">ID Thiết Bị:</label>
    <input type="text" id="id_tb_edit" name="id_tb_edit" required>

    <label for="ten_tb_edit">Tên Thiết Bị:</label>
    <input type="text" id="ten_tb_edit" name="ten_tb_edit" required>

    <label for="id_phong_edit">ID Phòng:</label>
    <input type="text" id="id_phong_edit" name="id_phong_edit" required>

    <label for="sl_tb_edit">Số Lượng:</label>
    <input type="text" id="sl_tb_edit" name="sl_tb_edit" required>

    <label for="dongia_tb_edit">Đơn Giá:</label>
    <input type="text" id="dongia_tb_edit" name="dongia_tb_edit" required>

    <label for="ghichu_tb_edit">Ghi Chú:</label>
    <input type="text" id="ghichu_tb_edit" name="ghichu_tb_edit">

    <input type="submit" name="edit" value="Sửa">
</form>

<hr>

<!-- Danh sách Thiết Bị -->
<h3>DANH SÁCH THIẾT BỊ</h3>
<table border="1">
    <tr>
        <th>ID Thiết Bị</th>
        <th>Tên Thiết Bị</th>
        <th>ID Phòng</th>
        <th>Số Lượng</th>
        <th>Đơn Giá</th>
        <th>Ghi Chú</th>
        <th>Thao Tác</th>
    </tr>

    <?php
    // Hiển thị danh sách thiết bị
    if ($result_all === false) {
        die("Lỗi trong truy vấn SQL: " . $conn->error);
    }
    while ($row = $result_all->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_tb']}</td>
                <td>{$row['ten_tb']}</td>
                <td>{$row['id_phong']}</td>
                <td>{$row['sl_tb']}</td>
                <td>{$row['dongia_tb']}</td>
                <td>{$row['ghichu_tb']}</td>
                <td>
                    <a href='edit.php?delete={$row['id_tb']}'>Xóa</a>
                </td>
              </tr>";
    }
    ?>
</table>

<p><a href="main.php">Quay lại Trang Chính</a></p>
</div>

</body>
</html>
