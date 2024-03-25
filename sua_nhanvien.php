<?php
// Kiểm tra xem người dùng đã gửi yêu cầu cập nhật thông tin nhân viên chưa
if (isset($_POST['update_employee'])) {
    // Lấy dữ liệu từ biểu mẫu
    $ma_nv = $_GET['id'];
    $ten_nv = $_POST['ten_nv'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    // Kết nối đến cơ sở dữ liệu
    require_once("config/db.class.php");
    require_once("entities/nhanvien.class.php");
    $db = new DB();

    // Tạo đối tượng nhân viên
    $employee = new NhanVien($ma_nv, $ten_nv, $gioi_tinh, $noi_sinh, $ma_phong, $luong);

    // Thực hiện cập nhật thông tin nhân viên trong cơ sở dữ liệu
    $result = $employee->update();

    // Kiểm tra kết quả cập nhật và thực hiện các hành động tương ứng
    if ($result) {
        // Cập nhật nhân viên thành công
        echo "<script>alert('Cập nhật thông tin nhân viên thành công.')</script>";
        echo "<script>window.location.href = 'index_admin.php';</script>";
        exit();
    } else {
        // Cập nhật nhân viên không thành công
        echo "<script>alert('Cập nhật thông tin nhân viên thất bại.')</script>";
        echo "<script>window.location.href = 'sua_nhanvien.php?ma_nv=" . $ma_nv . "';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin nhân viên</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Sửa thông tin nhân viên</h2>
        <?php
        // Lấy thông tin của nhân viên cần sửa từ cơ sở dữ liệu và hiển thị trong form
        require_once("config/db.class.php");
        require_once("entities/nhanvien.class.php");

        // Lấy mã nhân viên cần sửa từ URL
        $ma_nv = $_GET['ma_nv'];

        // Lấy thông tin nhân viên từ cơ sở dữ liệu
        $employee_info = NhanVien::get_employee_by_id($ma_nv);

        // Kiểm tra xem nhân viên có tồn tại không
        if ($employee_info) {
            echo '<form method="POST" action="update_employee.php">';
            echo '<input type="hidden" name="ma_nv" value="' . $employee_info['Ma_NV'] . '">'; // Trường ẩn chứa mã nhân viên
            echo '<div class="form-group">';
            echo '<label for="ten_nv">Tên nhân viên:</label>';
            echo '<input type="text" class="form-control" id="ten_nv" name="ten_nv" value="' . $employee_info['Ten_NV'] . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="gioi_tinh">Giới tính:</label>';
            echo '<select class="form-control" id="gioi_tinh" name="gioi_tinh" required>';
            echo '<option value="NAM" ' . ($employee_info['Phai'] == 'NAM' ? 'selected' : '') . '>Nam</option>';
            echo '<option value="NỮ" ' . ($employee_info['Phai'] == 'NU' ? 'selected' : '') . '>Nữ</option>';
            echo '</select>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="noi_sinh">Nơi sinh:</label>';
            echo '<input type="text" class="form-control" id="noi_sinh" name="noi_sinh" value="' . $employee_info['Noi_Sinh'] . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="ma_phong">Mã phòng:</label>';
            echo '<input type="text" class="form-control" id="ma_phong" name="ma_phong" value="' . $employee_info['Ma_Phong'] . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="luong">Lương:</label>';
            echo '<input type="number" class="form-control" id="luong" name="luong" value="' . $employee_info['Luong'] . '" required>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary" name="update_employee">Cập nhật nhân viên</button>';
            echo '</form>';
        } else {
            echo '<p class="text-danger">Không tìm thấy nhân viên có mã ' . $ma_nv . '</p>';
        }
        ?>
    </div>
</body>

</html>