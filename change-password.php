<?php
include './include/slug.php';
include './include/config.php';
$err = '';
if (isset($_SESSION['logins']['id'])) {
    $id = $_SESSION['logins']['id'];
    $sql = "SELECT * FROM user WHERE id = $id";
    $query = $conn->prepare($sql);
    $query->execute();
    $query_query = $query->fetch(PDO::FETCH_OBJ);
    if (isset($_POST['btn-change']) && ($_POST['btn-change'])) {
        $pass = $_POST['pass-old'];
        $checkPass = password_verify($pass, $query_query->password);
        if ($checkPass) {
            $pass_1 = $_POST['pass-news'];
            $pass_2 = $_POST['pass-newss'];
            if ($pass_1 != $pass_2) {
                $err = '0';
            } else if ($pass_1 == "") {
                $err = '2';
            } else {
                $pass_1 = password_hash($pass_1, PASSWORD_DEFAULT);
                $sql_update = "UPDATE user SET password='$pass_1'";
                $query = $conn->prepare($sql_update);
                $query_excute = $query->execute();
                $err = "4";
            }
        } else {
            $err = '1';
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
    <title>Thay đổi mật khẩu</title>
    <!-- link css  -->
    <?php
    include "./include/link-css.php";
    ?>
    <!-- /link css  -->
</head>

<body>
    <!-- header -->
    <?php
    include "./include/header.php";
    ?>
    <!-- /header -->
    <div class="main-site-setting">
        <div class="container">
            <div class="infor-setting">
                <h2>Thông tin cá nhân</h2>
                <?php if (isset($_SESSION['logins']['id'])) { ?>
                <div class="infor-setting-chil">
                    <div class="img-setting-infor">
                        <img src="<?php echo $result_setting->image ?>" alt="image">
                    </div>
                </div>
                <div class="text-setting">
                    <p class="setting-name"><span>họ tên:</span> <?php echo $query_query->name ?></p>
                    <p class="setting1 setting-username"><span>Tên người dùng: </span>
                        <?php echo $query_query->username ?></p>
                    <p class="setting1 setting-email"><span>Địa chỉ email: </span> <?php echo $query_query->email ?>
                    </p>
                    <p class="setting1 setting-phone"><span>Số điện thoại: </span> <?php echo $query_query->phone ?>
                    </p>
                    <p class="setting1 setting-address"><span>Địa chỉ: </span><?php echo $query_query->address ?></p>
                </div>
                <div class="update-set">
                    <p class="edit-infor-set">Cập nhập thông tin cá nhân</p>
                    <p class="edit-pass-set"><a href="./change-password.php">Cập nhập mật khẩu</a></p>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="password-password">
            <div class="change-password">
                <div class="h2-close">
                    <h2>cập nhật mật khẩu</h2>
                    <p class="close-form-password"><a href="./setting.php">X</a></p>
                </div>
                <?php if ($err == 4) { ?>
                <p class=" sus-setting">Cập nhật mật khẩu thành công!</p>
                <?php } ?>
                <form enctype='multipart/form-data' id="change-pass" action="" method="POST">
                    <div class="group-pass">
                        <h5>Nhập mật khẩu cũ:</h5>
                        <input type="password" name="pass-old" id="pass-old" class="pass-old">
                        <?php if ($err == 1) { ?>
                        <p>Mật khẩu cũ sai!</p>
                        <?php } ?>
                    </div>
                    <div class="group-pass">
                        <h5>Nhập mật khẩu mới:</h5>
                        <input type="password" name="pass-news" id="pass-news" class="pass-news">
                        <?php if ($err == 2) { ?>
                        <p>Mật khẩu mới không được trống</p>
                        <?php } ?>
                    </div>
                    <div class="group-pass">
                        <h5>Nhập lại mật khẩu mới:</h5>
                        <input type="password" name="pass-newss" id="pass-newss" class="pass-newss">
                        <?php if ($err == 0) { ?>
                        <p>Xác nhận mật khẩu mới không chính xác!</p>
                        <?php } ?>
                    </div>
                    <div class="group-pass1">
                        <input type="submit" value="Cập nhật" name="btn-change" id="btn-change" class="btn-change">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- footer  -->
    <?php
    include "./include/footer.php";
    ?>
    <!-- /footer  -->
</body>

</html>