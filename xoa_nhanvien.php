<?php
// Kiểm tra xem mã nhân viên được truyền từ URL có tồn tại không
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ma_nv = $_GET['id'];

    // Gọi phương thức xóa nhân viên từ class NhanVien
    require_once("entities/nhanvien.class.php");
    $result = NhanVien::delete($ma_nv);

    if ($result) {
        // Nếu xóa thành công, chuyển hướng về trang danh sách nhân viên và hiển thị thông báo
        echo "<script>alert('Xóa nhân viên thành công.')</script>";
        header("Location: index_admin.php");
        exit();
    } else {
        // Nếu không xóa được, hiển thị thông báo lỗi
        $error = "Xóa nhân viên không thành công!";
    }
} else {
    // Nếu không có mã nhân viên, hiển thị thông báo lỗi
    $error = "Không tìm thấy nhân viên cần xóa!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa nhân viên</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <?php if (isset($error)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
        <?php } ?>
    </div>
</body>

</html>