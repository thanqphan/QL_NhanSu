<?php
session_start();

// // Kiểm tra nếu người dùng đã đăng nhập, chuyển hướng họ đến trang chính
// if (isset($_SESSION['username'])) {
//     header('Location: index.php');
//     exit();
// }

// Xử lý đăng nhập khi người dùng gửi form
if (isset($_POST['login'])) {
    // Lấy thông tin đăng nhập từ form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra xem các trường dữ liệu đăng nhập có bị bỏ trống không
    if (empty($username) || empty($password)) {
        $error = "Vui lòng nhập tên người dùng và mật khẩu";
    } else {
        // Kết nối đến cơ sở dữ liệu
        require_once("config/db.class.php");
        $db = new DB();

        // Thực hiện truy vấn đăng nhập
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = $db->query_execute($query);

        // Kiểm tra xem có dòng kết quả trả về không
        if ($db->num_rows($result) > 0) {
            // Lấy thông tin người dùng từ kết quả truy vấn
            $user = $db->get_row($result);

            // Lưu vai trò của người dùng vào session
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            // Kiểm tra vai trò của người dùng và chuyển hướng đến trang phù hợp
            if ($user['role'] == 'admin') {
                header('Location: index_admin.php');
            } else {
                header('Location: index.php');
            }
            exit();
        } else {
            // Xử lý trường hợp đăng nhập không thành công
            $error = "Tên người dùng hoặc mật khẩu không đúng";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-3">Đăng nhập</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Tên người dùng:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Đăng nhập</button>
        </form>
        <?php if (isset($error)) echo "<p class='text-danger mt-3'>$error</p>"; ?>
    </div>
</body>

</html>