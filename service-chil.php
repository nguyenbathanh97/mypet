<?php
include './include/config.php';
$sql = "SELECT * FROM sevice";
$query= $conn -> prepare($sql);
$query-> execute();
$result = $query->fetch(PDO::FETCH_OBJ);
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
    <div class="main-service-chil">
        <div class="slider-service">
            <img src="./image/meo.jpg" alt="slider">
            <h2>Dịch vụ</h2>
            <h1 class="service-h1"><?php echo $result->title ?></h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-8 post-all-service">
                    <div class="post">

                    </div>
                    <div class="post-contact-service">
                        <h3 class="contact-service-h3">
                            Quý khách có nhu cầu vui lòng liên hệ
                        </h3>
                        <div class="service-hotline">
                            Hotline: <a target="_blank" href="tel:0988838275">0988838275</a>
                        </div>
                        <div class="service-address">
                            Address: <a target="_blank" href="#">Số 100, Đậu Yên, Trung Đô, TP Vinh, Nghệ An</a>
                        </div>
                        <div class="contact-service-all">
                            <div class="circle-contact">
                                <a target="_blank" href="https://www.facebook.com/ThanhMBlue/"><i class="fab fa-facebook-f"></i></a>
                            </div>
                            <div class="circle-contact">
                                <a target="_blank" href="https://www.facebook.com/ThanhMBlue/"><i class="fab fa-twitter"></i></a>
                            </div>
                            <div class="circle-contact">
                                <a target="_blank" href="https://www.facebook.com/ThanhMBlue/"><i class="fas fa-at"></i></a>
                            </div>
                            <div class="circle-contact">
                                <a target="_blank" href="https://www.facebook.com/ThanhMBlue/"><i class="fab fa-instagram"></i></a>
                            </div>
                            <div class="circle-contact">
                                <a target="_blank" href="https://www.facebook.com/ThanhMBlue/"><i class="fab fa-google-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tell-service-all">
                        <div class="tell-left">
                            <i class="fas fa-phone-volume"></i>
                            <a href="tel:0988838275">0988838275</a>
                        </div>
                        <div class="booking-service-right">
                            <input class="btn register-booking" type="submit" value="Đặt lịch khám">
                        </div>
                    </div>
                    <div class="form-booking">
                        <form class="form-booking-chil" action="" method="POST">
                            <div class="line-1">
                                <p>Đăng ký lịch hẹn khám tại My Pet</p>
                                <i class="booking-close fas fa-times"></i>
                            </div>
                            <div class="line-2">
                                <input type="text" placeholder="Họ tên" name="name">
                                <input type="text" placeholder="Điện thoại" name="phone">
                            </div>
                            <div class="line-3">
                                <input type="email" placeholder="Email" name="email">
                                <input type="date" placeholder="Ngày" name="number">
                            </div>
                            <div class="line-4">
                                <select name="" id="">
                                    <option value="1">--Lựa chọn dịch vụ--</option>
                                    <option value="2">Khám và điều trị bệnh chó</option>
                                    <option value="3">Khám và điều trị bệnh mèo</option>
                                    <option value="4">Khách sạn thú cưng</option>
                                </select>
                            </div>
                            <div class="line-5">
                                <textarea class="decs" name="" id="" cols="30" rows="10" placeholder="Nội dung yêu cầu"></textarea>
                            </div>
                            <div class="line-6">
                                <input type="submit" value="Đăng ký ngay" name="btn btn-register">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-4 right-service">
                    <div class="search search-service">
                        <input type="text" placeholder="Tìm kiếm">
                        <div class="icon">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <h1>bài viết mới nhất</h1>
                    <div class="title-news-service">
                        <div class="title-news-service-chil">
                            <div class="news-service-chil">
                                <a href="#"><img src="./image/khambenh.jpg" alt="image"></a>
                                <a class="desc" href="#">Siêu ưu đãi mổ thú cưng đảm bảo 100% thành công và an toàn Siêu ưu đãi mổ thú cưng đảm bảo 100% thành công và an toàn</a>
                            </div>
                            <div class="line"></div>
                        </div>
                        <div class="title-news-service-chil">
                            <div class="news-service-chil">
                                <a href="#"><img src="./image/khambenh.jpg" alt="image"></a>
                                <a class="desc" href="#">Siêu ưu đãi mổ thú cưng đảm bảo 100% thành công và an toàn Siêu ưu đãi mổ thú cưng đảm bảo 100% thành công và an toàn</a>
                            </div>
                            <div class="line"></div>
                        </div>
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