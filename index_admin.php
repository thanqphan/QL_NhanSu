<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    // Nếu chưa, chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit();
}

// Kiểm tra xem người dùng có phải là admin không
if ($_SESSION['role'] !== 'admin') {
    // Nếu không phải admin, hiển thị thông báo và chuyển hướng về trang chính
    echo "Bạn không có quyền truy cập vào trang này.";
    exit();
}

// Nếu là admin, hiển thị giao diện và các chức năng thêm, xoá, sửa nhân viên
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên (Admin)</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Danh sách nhân viên (Admin)</h2>
        <a href="add_nhanvien.php" class="btn btn-primary">Thêm nhân viên</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã NV</th>
                    <th scope="col">Tên NV</th>
                    <th scope="col">Giới tính</th>
                    <th scope="col">Nơi sinh</th>
                    <th scope="col">Mã phòng</th>
                    <th scope="col">Lương</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("config/db.class.php");
                require_once("entities/nhanvien.class.php");

                $total_records = count(NhanVien::list_nhanvien());
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $limit = 5;
                $start = ($current_page - 1) * $limit;

                $nhanviens = NhanVien::list_nhanvien_page($start, $limit);

                foreach ($nhanviens as $nhanvien) {
                    echo "<tr>";
                    echo "<td>{$nhanvien['Ma_NV']}</td>";
                    echo "<td>{$nhanvien['Ten_NV']}</td>";
                    echo "<td>";
                    if ($nhanvien['Phai'] == 'NAM') {
                        echo '<img src="img/man.png" alt="Nam" style="width: 30px; height: 30px;">';
                    } else {
                        echo '<img src="img/female.png" alt="Nữ" style="width: 30px; height: 30px;">';
                    }
                    echo "</td>";
                    echo "<td>{$nhanvien['Noi_Sinh']}</td>";
                    echo "<td>{$nhanvien['Ma_Phong']}</td>";
                    echo "<td>{$nhanvien['Luong']}</td>";
                    echo "<td>
                            <a href='sua_nhanvien.php?id={$nhanvien['Ma_NV']}' class='btn btn-warning'>Sửa</a>
                            <a href='xoa_nhanvien.php?id={$nhanvien['Ma_NV']}' class='btn btn-danger'>Xoá</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php
                $total_pages = ceil($total_records / $limit);
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
                ?>
            </ul>
        </nav>
        <a href="main.php" class="btn btn-primary">Quay về</a>

    </div>
</body>

</html>