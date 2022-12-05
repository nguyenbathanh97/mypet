<?php
include './include/slug.php';
include './include/config.php';

$sqlSl = "SELECT * FROM contact";
$query = $conn->prepare($sqlSl);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
if (isset($_POST['btn-rq']) && ($_POST['btn-rq'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $content = $_POST['desc'];
    $sql = "INSERT INTO contact (name,email, address, phone, content) VALUES (:name, :email, :address, :phone, :desc)";
    $query = $conn->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->bindParam(':desc', $content, PDO::PARAM_STR);
    $query_excute = $query->execute();
    if ($query_excute) {
        $_SESSION['message'] = 'Đã gửi!';
        header('location: ./contact.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Lỗi!';
        header('location: ./contact.php');
        exit(0);
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
    <div class="main-contact">
        <div class="container">
            <div class="row">
                <div class="col-6 contact-image">
                    <img src="./image/anh-thu.png" alt="image">
                </div>
                <div class="main-contact-form col-6">
                    <div class="contact-form">
                        <h1>Liên hệ với chúng thôi</h1>
                        <form action="" method="POST" enctype='multipart/form-data'>
                            <div class="contact-us">
                                <input type="text" placeholder="Họ tên" name="name">
                                <input type="address" placeholder="Địa chỉ" name="address">
                            </div>
                            <div class="contact-us">
                                <input type="phone" placeholder="Điện thoại" name="phone">
                                <input type="mail" placeholder="Địa chỉ mail" name="email">
                            </div>
                            <div class="contact-us">
                                <textarea class="desc" name="desc" id="" cols="30" rows="10" placeholder="Nội dung yêu cầu"></textarea>
                            </div>
                            <div class="contact-us-rq">
                                <input type="submit" value="Gửi yêu cầu" name="btn-rq" class="btn-rq">
                            </div>
                        </form>
                    </div>
                </div>
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