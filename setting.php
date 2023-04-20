<?php
include './include/slug.php';
include './include/config.php';
if (isset($_SESSION['logins']['id'])) {
    $change = $_SESSION['logins']['id'];
    $sql_setting = "SELECT * FROM user  WHERE id = $change";
    $query_setting = $conn->prepare($sql_setting);
    $query_setting->execute();
    $result_setting = $query_setting->fetch(PDO::FETCH_OBJ);

    $id = $_SESSION['logins']['id'];
    $sqls = "SELECT * FROM user WHERE id = $id";
    $querys = $conn->prepare($sqls);
    $querys->execute();
    $results = $querys->fetch(PDO::FETCH_OBJ);
    if (isset($_POST['btn-updates']) && ($_POST['btn-updates'])) {
        $names = $_POST['names'];
        $usernames = $_POST['usernames'];
        $emails = $_POST['emails'];
        $phones = $_POST['phones'];
        $addresss = $_POST['addresss'];
        if (isset($_FILES["image"])) {
            $imagePNG = basename($_FILES["image"]["name"]);
            if (empty($imagePNG)) {
                $target_file = $results->image;
            } else {
                $imageName = strtolower(vn2en($imagePNG));
                $target_dir = "./image/";
                $target_file = $target_dir . $imageName;
                move_uploaded_file($_FILES["image"]["tmp_name"], "./image/" . $imageName);
            }
        }
        $sql = "UPDATE user SET name = '$names',username = '$usernames',  email = '$emails', phone = '$phones', address = '$addresss',image = '$target_file' WHERE id = $id";
        $query = $conn->prepare($sql);
        $query_excute = $query->execute();
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
                    <p class="setting-name"><span>họ tên:</span> <?php echo $result_setting->name ?></p>
                    <p class="setting1 setting-username"><span>Tên người dùng: </span>
                        <?php echo $result_setting->username ?></p>
                    <p class="setting1 setting-email"><span>Địa chỉ email: </span> <?php echo $result_setting->email ?>
                    </p>
                    <p class="setting1 setting-phone"><span>Số điện thoại: </span> <?php echo $result_setting->phone ?>
                    </p>
                    <p class="setting1 setting-address"><span>Địa chỉ: </span><?php echo $result_setting->address ?></p>
                </div>
                <div class="update-set">
                    <p class="edit-infor-set">Cập nhập thông tin cá nhân</p>
                    <p class="edit-pass-set"><a href="./change-password.php">Cập nhập mật khẩu</a></p>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="setting-setting">
            <div class="setting">
                <form id="form-setting" action="" method="POST" enctype='multipart/form-data'>
                    <p class="close-infor">X</p>
                    <h2>Thông tin cá nhân</h2>
                    <div class="group-setting">
                        <h5>Họ tên:</h5>
                        <input type="text" value="<?php echo $result_setting->name ?>" name="names" id="names"
                            class="names">
                        <p></p>
                    </div>
                    <div class="group-setting">
                        <h5>Tên đăng nhập:</h5>
                        <input type="text" value="<?php echo $result_setting->username ?>" name="usernames"
                            id="usernames" class="usernames">
                        <p></p>
                    </div>
                    <div class="group-setting">
                        <h5>Email:</h5>
                        <input type="mail" value="<?php echo $result_setting->email ?>" name="emails" id="emails"
                            class="emails">
                        <p></p>
                    </div>
                    <div class="group-setting">
                        <h5>Điện thoại:</h5>
                        <input type="text" value="<?php echo $result_setting->phone ?>" name="phones" id="phones"
                            class="phones">
                        <p></p>
                    </div>
                    <div class="group-setting">
                        <h5>Địa chỉ:</h5>
                        <input type="address" value="<?php echo $result_setting->address ?>" name="addresss"
                            id="addressss" class="addresss">
                        <p></p>
                    </div>
                    <div class="group-setting-img">
                        <h5>Ảnh đại diện:</h5>
                        <div class="img-img">
                            <input type="file" name="image" id="image-avatars" class="image-avatars"
                                onchange="ImageFileAsUrlEditInfor()">
                            <div id="display-image">
                                <p>ảnh mới chọn</p>
                                <div id="display-edit-infor"></div>
                            </div>
                            <div id="display-image1">
                                <p>ảnh trước đó</p>
                                <div id="display-edit-infor-old">
                                    <img src="<?php echo $results->image ?> " alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="group-setting-btn">
                        <input type="submit" value="Cập nhật" name="btn-updates" id="btn-updates" class="btn-updates">
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