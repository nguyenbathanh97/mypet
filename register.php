<?php
include "./include/config.php";
$image = './image/user.png';
//kiểm tra thông tin khi bấm nút submit
if (isset($_POST['btn-register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $comfim = $_POST['comfim'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if ($password != $comfim) {
        $_SESSION['name'] = $name;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['comfim'] = $comfim;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['address'] = $address;

        //hiển thị lỗi
        $_SESSION['error'] = 'Mật khẩu không khớp!';
    } else {
        //Kiểm tra người dùng đã tồn tại
        $sql = "SELECT * FROM user WHERE username=:username";
        $query = $conn->prepare($sql);
        $query->execute(['username' => $username]);
        if ($query->rowCount() > 0) {
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['comfim'] = $comfim;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;
            $_SESSION['address'] = $address;
            $_SESSION['status'] = $status = 0;
            //hiển thị lỗi
            $_SESSION['error'] = 'Người dùng đã tồn tại';
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (name, username, password, email, phone, address, image) VALUES (:name, :username, :password, :email, :phone, :address, :image)";
            $query = $conn->prepare($sql);
            try {
                $query->execute(['name' => $name, 'username' => $username, 'password' => $password, 'email' => $email, 'phone' => $phone, 'address' => $address, 'image' => $image]);

                $_SESSION['success'] = 'Người dùng đã tạo thành công. Bây giờ đã bạn có thể <a class="login-here" href="login.php">đăng nhập</a>';
            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./admin/css-admin/style.css">
</head>

<body>
    <div class="main-register">
        <div class="form-register">
            <form action="" method="POST">
                <div class="register-line">
                    <h1 class="title-register">Đăng ký</h1>
                </div>
                <?php
                if (isset($_SESSION['error'])) {
                    echo "
                        <div class='alert-error'>
                        <i class='fas fa-exclamation-triangle'></i> " . $_SESSION['error'] . "
                        </div>";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "
                        <div class='alert-success'>
                            <i class='fas fa-check'></i> " . $_SESSION['success'] . "
                        </div>";
                    unset($_SESSION['success']);
                }
                ?>
                <div class="register-line">
                    <div class="center-register">
                        <div class="td-all name-td">
                            <p>Họ tên:</p>
                            <input type="text" placeholder="Họ tên" name="name" class="name">
                        </div>
                        <div class="td-all username-td">
                            <p>Tài khoản:</p>
                            <input type="text" placeholder="Tài khoản" name="username" class="username">
                        </div>
                    </div>
                </div>
                <div class="register-line">
                    <div class="center-register">
                        <div class="td-all password-td">
                            <p>Mật khẩu:</p>
                            <input type="password" placeholder="Mật khẩu" name="password" class="password">
                        </div>
                        <div class="td-all comfim-td">
                            <p>Nhập lại mật khẩu:</p>
                            <input type="password" placeholder="Mật khẩu" name="comfim" class="comfim">
                        </div>
                    </div>
                </div>
                <div class="register-line">
                    <div class="center-register">
                        <div class="td-all email-td">
                            <p>Địa chỉ email:</p>
                            <input type="mail" placeholder="Địa chỉ mail" name="email" class="email">
                        </div>
                        <div class="td-all phone-td">
                            <p>Điện thoại:</p>
                            <input type="phone" placeholder="Điện thoại" name="phone" class="phone">
                        </div>
                    </div>
                </div>
                <div class="td-all address-td">
                    <p>Địa chỉ:</p>
                    <input type="text" placeholder="Địa chỉ" name="address" class="address">
                </div>
                <div class="register-line">
                    <input type="submit" value="Đăng ký" name="btn-register" class="btn-register">
                </div>
                <div class="register-line">
                    <a class="yes-account" href="login.php">Bạn đã có tài khoản?</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="./js/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="./js-admin/main-admin.js"></script>
</body>

</html>