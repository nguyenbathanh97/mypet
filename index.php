<?php
include './include/config.php';
// slider
$sql = "SELECT * FROM slider";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
// about
$sql_about = "SELECT * FROM about";
$query_about = $conn->prepare($sql_about);
$query_about->execute();
$result_about = $query_about->fetch(PDO::FETCH_OBJ);
// sevice
$sql_sevice = "SELECT * FROM sevice";
$query_sevice = $conn->prepare($sql_sevice);
$query_sevice->execute();
$result_sevice = $query_sevice->fetchAll(PDO::FETCH_OBJ);
//  news
$sql = "SELECT * FROM news";
$query = $conn->prepare($sql);
$query->execute();
$result_news = $query->fetchAll(PDO::FETCH_OBJ);
// var_dump($result); die();
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
    <div class="main">
        <div class="home">
            <div class="slide-home">
                <div id="slide">
                    <?php foreach ($result as $key => $value) { ?>
                        <div class="item">
                            <img src="<?php echo $value->image ?>" alt="image">
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="about-us col-6">
                    <h3>Về chúng tôi</h3>
                    <h1><?php echo $result_about->title ?></h1>
                    <div class="desc_about"><?php echo $result_about->content ?></div>
                    <a class="more" href="./information.php">Xem thêm >></a>
                </div>
                <div class="about-us-img col-6">
                    <img src="./image/anh-thu.png" alt="image">
                </div>
                <div class="why-change-us">
                    <div class="container">
                        <div class="why-change-us-top">
                            <img src="./image/logo-pethealth.png" alt="image">
                            <h1>Tại sao chọn chúng tôi</h1>
                            <p>Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến nhất, và đội ngũ bác sĩ thú y dày dạn
                                kinh nghiệm để đem lại cho thú cưng của các bạn một dịch vụ chu đáo và sự chăm sóc kĩ lưỡng nhất.</p>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="why-change-us-right">
                                    <img src="./image/us.png" alt="image">
                                    <h5 class="title">
                                        ĐỘI NGŨ BÁC SĨ CHUYÊN NGHIỆP
                                    </h5>
                                    <p class="describe">
                                        Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến nhất, và đội ngũ bác sĩ thú y dày dạn
                                        kinh nghiệm để đem lại cho thú cưng của các bạn một dịch vụ chu đáo và sự chăm sóc kĩ lưỡng nhất.
                                    </p>
                                </div>
                                <div class="why-change-us-right">
                                    <img src="./image/us.png" alt="image">
                                    <h5 class="title">
                                        ĐỘI NGŨ BÁC SĨ CHUYÊN NGHIỆP
                                    </h5>
                                    <p class="describe">
                                        Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến nhất, và đội ngũ bác sĩ thú y dày dạn
                                        kinh nghiệm để đem lại cho thú cưng của các bạn một dịch vụ chu đáo và sự chăm sóc kĩ lưỡng nhất.
                                    </p>
                                </div>
                                <div class="why-change-us-right">
                                    <img src="./image/us.png" alt="image">
                                    <h5 class="title">
                                        ĐỘI NGŨ BÁC SĨ CHUYÊN NGHIỆP
                                    </h5>
                                    <p class="describe">
                                        Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến nhất, và đội ngũ bác sĩ thú y dày dạn
                                        kinh nghiệm để đem lại cho thú cưng của các bạn một dịch vụ chu đáo và sự chăm sóc kĩ lưỡng nhất.
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="image-center">
                                    <img src="./image/anh-center.png" alt="image">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="why-change-us-left">
                                    <img src="./image/us.png" alt="image">
                                    <h5 class="title">
                                        ĐỘI NGŨ BÁC SĨ CHUYÊN NGHIỆP
                                    </h5>
                                    <p class="describe">
                                        Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến nhất, và đội ngũ bác sĩ thú y dày dạn
                                        kinh nghiệm để đem lại cho thú cưng của các bạn một dịch vụ chu đáo và sự chăm sóc kĩ lưỡng nhất.
                                    </p>
                                </div>
                                <div class="why-change-us-left">
                                    <img src="./image/us.png" alt="image">
                                    <h5 class="title">
                                        ĐỘI NGŨ BÁC SĨ CHUYÊN NGHIỆP
                                    </h5>
                                    <p class="describe">
                                        Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến nhất, và đội ngũ bác sĩ thú y dày dạn
                                        kinh nghiệm để đem lại cho thú cưng của các bạn một dịch vụ chu đáo và sự chăm sóc kĩ lưỡng nhất.
                                    </p>
                                </div>
                                <div class="why-change-us-left">
                                    <img src="./image/us.png" alt="image">
                                    <h5 class="title">
                                        ĐỘI NGŨ BÁC SĨ CHUYÊN NGHIỆP
                                    </h5>
                                    <p class="describe">
                                        Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến nhất, và đội ngũ bác sĩ thú y dày dạn
                                        kinh nghiệm để đem lại cho thú cưng của các bạn một dịch vụ chu đáo và sự chăm sóc kĩ lưỡng nhất.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-us">
            <div class="container">
                <div class="logo-service-us">
                    <img src="./image/logo-pethealth.png" alt="image">
                </div>
                <h1>Dịch vụ của chúng tôi</h1>
                <h5>Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến</h5>
                <div class="row">
                    <div class="col-8">
                        <div class="row service-us-fath">
                            <?php foreach ($result_sevice as $key => $value) { ?>
                                <div class="service-us-left col-3">
                                    <img src="<?php echo $value->image ?>" alt="">
                                    <h4><?php echo $value->title ?></h4>
                                    <div class="p"><?php echo $value->content ?></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="booking">
                            <h1><i class="fas fa-user-md"></i> Dịch vụ thú y cao cấp</h1>
                            <ul>
                                <li><i class="fas fa-hand-point-right"></i> Tư vấn tận tình</li>
                                <li><i class="fas fa-hand-point-right"></i> Khám chữa bệnh chuyên nghiệp</li>
                                <li><i class="fas fa-hand-point-right"></i> Phẫu thuật chất lượng cao</li>
                                <li><i class="fas fa-hand-point-right"></i> Tiết kiệm chi phí</li>
                                <li><i class="fas fa-hand-point-right"></i> Giải pháp toàn diện</li>
                            </ul>
                            <h3><i class="fas fa-user-edit"></i> Vui lòng điền đầy đủ thông tin</h3>
                            <p>Chỉ cần hẹn trước để được giúp đỡ từ các chuyên gia của chúng tôi</p>
                            <input type="submit" name="" class="register-booking" value="Đặt lịch khám bệnh">
                        </div>
                    </div>
                </div>
            </div>

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
    <div class="post-service">
        <div class="container">
            <div class="logo-post-service">
                <div class="logo">
                    <img src="./image/logo-pethealth.png" alt="logo">
                </div>
                <h1>Chăm sóc thú cưng</h1>
            </div>
            <div class="row">
                <div class="post-service-slide">
                    <?php foreach ($result_news as $key => $value) { ?>
                        <div class="post-all">
                            <a href="#"><img src="<?php echo $value->image ?>" alt="" class="post-img"></a>
                            <a href="#">
                                <h1 class="post-title"><?php echo $value->title ?></h1>
                            </a>
                            <div class="post-desc"><?php echo $value->content ?></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="pet-show">
        <div class="container">
            <div class="logo-pet-show">
                <div class="logo">
                    <img src="./image/logo-pethealth.png" alt="logo">
                </div>
                <h1>Pet shop</h1>
                <p>Cung cấp các loại sản phẩm cho thú cưng</p>
            </div>
            <div class="row pet-show-in">
                <div class="col-3 pet-shop-chil">
                    <div class="pet-shop-chil-in">
                        <a href="#"><img src="./image/khambenh.jpg" alt="" class="pet-shop-img"></a>
                        <a class="pet-shop-title" href="#">Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó</a>
                        <div class="more">
                            <a href="#">
                                <p>Xem thêm <i class="fas fa-angle-double-right"></i></p>
                            </a>
                        </div>
                        <div class="icon-buy">
                            <i class="buy fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-3 pet-shop-chil">
                    <div class="pet-shop-chil-in">
                        <a href="#"><img src="./image/khambenh.jpg" alt="" class="pet-shop-img"></a>
                        <a class="pet-shop-title" href="#">Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó</a>
                        <div class="more">
                            <a href="#">
                                <p>Xem thêm <i class="fas fa-angle-double-right"></i></p>
                            </a>
                        </div>
                        <div class="icon-buy">
                            <i class="buy fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-3 pet-shop-chil">
                    <div class="pet-shop-chil-in">
                        <a href="#"><img src="./image/khambenh.jpg" alt="" class="pet-shop-img"></a>
                        <a class="pet-shop-title" href="#">Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó</a>
                        <div class="more">
                            <a href="#">
                                <p>Xem thêm <i class="fas fa-angle-double-right"></i></p>
                            </a>
                        </div>
                        <div class="icon-buy">
                            <i class="buy fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-3 pet-shop-chil">
                    <div class="pet-shop-chil-in">
                        <a href="#"><img src="./image/khambenh.jpg" alt="" class="pet-shop-img"></a>
                        <a class="pet-shop-title" href="#">Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó</a>
                        <div class="more">
                            <a href="#">
                                <p>Xem thêm <i class="fas fa-angle-double-right"></i></p>
                            </a>
                        </div>
                        <div class="icon-buy">
                            <i class="buy fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-3 pet-shop-chil">
                    <div class="pet-shop-chil-in">
                        <a href="#"><img src="./image/khambenh.jpg" alt="" class="pet-shop-img"></a>
                        <a class="pet-shop-title" href="#">Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó</a>
                        <div class="more">
                            <a href="#">
                                <p>Xem thêm <i class="fas fa-angle-double-right"></i></p>
                            </a>
                        </div>
                        <div class="icon-buy">
                            <i class="buy fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-3 pet-shop-chil">
                    <div class="pet-shop-chil-in">
                        <a href="#"><img src="./image/khambenh.jpg" alt="" class="pet-shop-img"></a>
                        <a class="pet-shop-title" href="#">Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó Rọ mõm hình mỏ vịt chó</a>
                        <div class="more">
                            <a href="#">
                                <p>Xem thêm <i class="fas fa-angle-double-right"></i></p>
                            </a>
                        </div>
                        <div class="icon-buy">
                            <i class="buy fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="newws">
        <div class="container">
            <div class="title-news">
                <div class="logo">
                    <img src="./image/logo-pethealth.png" alt="logo">
                </div>
                <h1>Tin tức nổi bật</h1>
            </div>
            <div class="row">
                <?php foreach ($result_news as $key => $value) { ?>
                    <div class="col-6 news-chil">
                        <div class="news-chil-image">
                            <a href="#"><img src="<?php echo $value->image ?>" alt="image"></a>
                        </div>
                        <div class="news-chil-title">
                            <a href="#">
                                <h1><?php echo $value->title ?></h1>
                            </a>
                            <div class="desc-p"><?php echo $value->content ?></div>
                        </div>
                    </div>
                <?php } ?>
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