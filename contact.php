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
                        <form action="" method="POST">
                            <div class="contact-us">
                                <input type="text" placeholder="Họ tên" name="name">
                                <input type="address" placeholder="Địa chỉ" name="address">
                            </div>
                            <div class="contact-us">
                                <input type="phone" placeholder="Điện thoại" name="phone">
                                <input type="mail" placeholder="Địa chỉ mail" name="mail">
                            </div>
                            <div class="contact-us">
                                <textarea class="decs" name="" id="" cols="30" rows="10" placeholder="Nội dung yêu cầu"></textarea>
                            </div>
                            <div class="contact-us-rq">
                                <input type="submit" value="Gửi yêu cầu" name="" class="btn btn-rq">
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