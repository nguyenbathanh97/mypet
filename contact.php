<?php
include './include/slug.php';
include './include/config.php';

$success = "";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        header('./contact.php');
        $success = 1;
        $succ_contact = 'Gửi yêu cầu thành công <br> Cảm ơn bạn đã tin tưởng sử dụng dịch vụ của chúng tôi!';
    } else {
        header('./contact.php');
        $error = 1;
        $err_contact = 'Gửi yêu cầu thất bại';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
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
                        <?php if ($success == 1) { ?>
                        <div class="succ-contact"><?php echo $succ_contact ?></div>
                        <?php } ?>
                        <form id="contact-form" action="" method="POST" enctype='multipart/form-data'>
                            <div class="contact-us">
                                <div class="contact-group">
                                    <label class="title-contact">Họ tên</label><br>
                                    <input id="fullname" type="text" placeholder="Họ tên" name="name"><br>
                                    <p class="contact-message"></p>
                                </div>
                                <div class="contact-group">
                                    <label class="title-contact">Địa chỉ</label><br>
                                    <input id="address" type="text" placeholder="Địa chỉ" name="address"><br>
                                    <p class="contact-message"></p>
                                </div>
                            </div>
                            <div class="contact-us">
                                <div class="contact-group">
                                    <label class="title-contact">Điện thoại</label><br>
                                    <input id="phone" type="phone" placeholder="Điện thoại" name="phone"><br>
                                    <p class="contact-message"></p>
                                </div>
                                <div class="contact-group">
                                    <label class="title-contact">Mail</label><br>
                                    <input id="email" type="mail" placeholder="Địa chỉ mail" name="email"><br>
                                    <p class="contact-message"></p>
                                </div>
                            </div>
                            <div class="contact-us">
                                <div class="contact-group">
                                    <label class="title-contact">Nội dung yêu cầu</label><br>
                                    <textarea class="desc" name="desc" id="desc" cols="30" rows="10"
                                        placeholder="Nội dung yêu cầu"></textarea><br>
                                    <p class="contact-message"></p>
                                </div>
                            </div>
                            <div class="contact-us-rq">
                                <input type="submit" value="Gửi yêu cầu" name="btn-rq" class="btn-rq">
                                <!-- <button name="btn-rq">Gửi yêu cầu</button> -->
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
    <script src="./js/validator.js"></script>
    <script>
    Validator({
        form: '#contact-form',
        formGroupSelector: '.contact-group',
        errorSelector: ".contact-message",
        rules: [
            Validator.isRequired('#fullname', 'Vui lòng nhập đầy đủ họ tên!'),
            Validator.isRequired('#address', 'Vui lòng nhập địa chỉ!'),
            Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại!'),
            Validator.isPhone('#phone', 'Số điện thoại gồm 10 số và bắt đầu từ số 0'),
            Validator.isRequired('#email', 'Vui lòng nhập địa chỉ mail!'),
            Validator.isEmail('#email'),
            Validator.isRequired('#desc', 'Vui lòng nhập nội dung!'),
            // Validator.isRequired('#fullname', 'Vui lòng nhập đầy đủ họ tên!'), 
            // Validator.minLength('#username',4,'Tên đăng nhập phải chứa ít nhất 4 ký tự'), 
            // Validator.maxLength('#username',20,'Tên đăng nhập chứa tối đa 20 ký tự'), 
            // Validator.isUserName('#username', 'Tên đăng nhập chỉ bao gồm chữ cái và số'), 

            // Validator.isRequired('#password'),
            // Validator.isPassword('#password',6, 30),

            // Validator.isRequired('#password-confirmation'),
            // Validator.isConfirmed('#password-confirmation', function (){
            //     return document.querySelector('#frm-register #password').value;
            // }, 'Mật khẩu không trùng khớp'),

            // Validator.isRequired('#fullname'),

            // Validator.isRequired('#phone'),
            // Validator.isPhone('#phone', 'Số điện thoại gồm 10 số và bắt đầu từ số 0'),

            // Validator.isRequired('#email'),
            // Validator.isEmail('#email'),
        ],
    });
    </script>

</body>

</html>