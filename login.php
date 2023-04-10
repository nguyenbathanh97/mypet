<?php
include './include/config.php';
$err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username=:username";
    $query = $conn->prepare($sql);
    $query->bindParam(':username', $user, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    // var_dump($query->rowCount());
    // die();
    if ($query->rowCount() > 0) {
        $checkPass = password_verify($pass, $results->password);
        // var_dump($checkPass);
        // die();
        if ($checkPass) {
            $_SESSION['logins']['id'] = $results->id;
            $_SESSION['logins']['username'] = $results->username;
            $_SESSION['logins']['password'] = $results->password;
            $_SESSION['logins']['name'] = $results->name;
            $_SESSION['logins']['email'] = $results->email;
            $_SESSION['logins']['phone'] = $results->phone;
            $_SESSION['logins']['address'] = $results->address;
            $_SESSION['logins']['status'] = $results->status;
            // var_dump($_SESSION['logins']['status']);
            // die();
            if ($results->status == 0) {
                header('location: ./index.php');
            } else {
                header('location: ./admin/control.php');
            }
        } else {
            $err = "1";
        }
    } else {
        $err = "1";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="../lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./admin/css-admin/style.css">

</head>

<body>
    <div class="main-login">
        <div class="form-login">
            <form action="" method="POST">
                <div class="form-line">
                    <h1 class="title-login">Đăng nhập</h1>
                    <div class="err-all">
                        <?php if ($err == 1) { ?>
                        <div class="err-all-chil">
                            <p class="err-p">
                                <i class="fas fa-exclamation-triangle"></i>
                                Mật khẩu hoặc tài khoản không đúng, vui lòng thử lại
                            </p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-line">
                    <p>Tài khoản:</p>
                    <input type="text" placeholder="Tài khoản" name="username" class="username">
                </div>
                <div class="form-line">
                    <p>Mật khẩu:</p>
                    <input type="password" placeholder="Mật khẩu" name="password" class="password">
                </div>
                <div class="form-line">
                    <input type="submit" value="Đăng nhập" name="btn-login" class="btn-login">
                </div>
                <div class="form-line">
                    <a class="no-account" href="register.php">Bạn chưa có tài khoản?</a>
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