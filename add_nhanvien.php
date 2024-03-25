<?php
// Kiểm tra xem người dùng đã gửi yêu cầu thêm nhân viên chưa
if (isset($_POST['add_nhanvien'])) {
    // Lấy dữ liệu từ biểu mẫu
    $ma_nv = $_POST['ma_nv'];
    $ten_nv = $_POST['ten_nv'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    // Kết nối đến cơ sở dữ liệu
    require_once("config/db.class.php");
    require_once("entities/nhanvien.class.php");
    $db = new DB();

    // Tạo đối tượng nhân viên mới
    $new_employee = new NhanVien($ma_nv, $ten_nv, $gioi_tinh, $noi_sinh, $ma_phong, $luong);

    // Thêm nhân viên vào cơ sở dữ liệu
    $result = $new_employee->save();

    // Kiểm tra kết quả thêm nhân viên và thực hiện các hành động tương ứng
    if ($result) {
        // Thêm nhân viên thành công
        echo "<script>alert('Thêm nhân viên thành công.')</script>";
        echo "<script>window.location.href = 'index_admin.php';</script>";
        exit();
    } else {
        // Thêm nhân viên không thành công
        echo "<script>alert('Thêm nhân viên thất bại.')</script>";
        echo "<script>window.location.href = 'add_nhanvien.php';</script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Thêm nhân viên</h2>
        <form method="POST" action="add_nhanvien.php">
            <div class="form-group">
                <label for="ma_nv">Mã nhân viên:</label>
                <input type="text" class="form-control" id="ma_nv" name="ma_nv" required>
            </div>
            <div class="form-group">
                <label for="ten_nv">Tên nhân viên:</label>
                <input type="text" class="form-control" id="ten_nv" name="ten_nv" required>
            </div>
            <div class="form-group">
                <label for="gioi_tinh">Giới tính:</label>
                <select class="form-control" id="gioi_tinh" name="gioi_tinh" required>
                    <option value="NAM">Nam</option>
                    <option value="NU">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="noi_sinh">Nơi sinh:</label>
                <input type="text" class="form-control" id="noi_sinh" name="noi_sinh" required>
            </div>
            <div class="form-group">
                <label for="ma_phong">Mã phòng:</label>
                <input type="text" class="form-control" id="ma_phong" name="ma_phong" required>
            </div>
            <div class="form-group">
                <label for="luong">Lương:</label>
                <input type="number" class="form-control" id="luong" name="luong" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_nhanvien">Thêm nhân viên</button>
        </form>
    </div>
</body>

</html>