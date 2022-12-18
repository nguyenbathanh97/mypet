<?php
include './include/config.php';
// slider
$sql = "SELECT * FROM slider WHERE status_slider = 1";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
// about
$sql_about = "SELECT * FROM about WHERE status_about = 1";
$query_about = $conn->prepare($sql_about);
$query_about->execute();
$result_about = $query_about->fetch(PDO::FETCH_OBJ);
// sevice
$sql_sevice = "SELECT * FROM sevice WHERE status_sevice = 1";
$query_sevice = $conn->prepare($sql_sevice);
$query_sevice->execute();
$result_sevice = $query_sevice->fetchAll(PDO::FETCH_OBJ);
// var_dump($result_sevice); die();

//  shop
$sql_shop = "SELECT * FROM shop  WHERE status_shop = 1";
$query_shop = $conn->prepare($sql_shop);
$query_shop->execute();
$result_shop = $query_shop->fetchAll(PDO::FETCH_OBJ);

// var_dump($result); die();

//  news
$sql_news = "SELECT * FROM news WHERE status_news = 1";
$query_news = $conn->prepare($sql_news);
$query_news->execute();
$result_news = $query_news->fetchAll(PDO::FETCH_OBJ);
// var_dump($result); die();
// isset($_POST['btn-add-form']) && ($_POST['btn-add-form']);
$success_booking = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $select = $_POST['select'];
    $content = $_POST['desc'];
    $sql = "INSERT INTO booking (name, phone, email, date, id_sevice, content_booking) VALUES(:name, :phone, :email, :date, :select, :desc)";
    $query = $conn->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':select', $select, PDO::PARAM_STR);
    $query->bindParam(':desc', $content, PDO::PARAM_STR);
    $query_booking = $query->execute();
    // if ($query_booking) {
    //     $success_booking = 5;
    //     $succ_booking = 'Gửi yêu cầu thành công <br> Cảm ơn bạn đã tin tưởng sử dụng dịch vụ của chúng tôi!';
    // } else {
    //     $error = 5;
    //     $err_booking = 'Gửi yêu cầu thất bại';
    // }
    // var_dump($success_booking);
    // die();
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
                                        Chúng tôi cung cấp dịch vụ chăm sóc y tế tận tình, công nghệ tiên tiến nhất.
                                    </p>
                                </div>
                                <div class="why-change-us-right">
                                    <img src="./image/us.png" alt="image">
                                    <h5 class="title">
                                        UY TÍN TẬN TÂM
                                    </h5>
                                    <p class="describe">
                                        Tất cả các trang thiết bị tại phòng chuyên môn đều đạt tiêu chuẩn của Bộ NN.
                                    </p>
                                </div>
                                <div class="why-change-us-right">
                                    <img src="./image/us.png" alt="image">
                                    <h5 class="title">
                                        TƯ VẤN MIỄN PHÍ
                                    </h5>
                                    <p class="describe">
                                        Chúng tôi sẵn sàng giúp bạn giải đáp mọi thắc mắc với đội ngũ giàu kinh nghiệm.
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
                                        TRÁCH NHIỆM NHIỆT TÌNH
                                    </h5>
                                    <p class="describe">
                                        Để đáp ứng nhu cầu của khách hàng chúng tôi phục vụ tất cả các ngày trong năm.
                                    </p>
                                </div>
                                <div class="why-change-us-left">
                                    <img src="./image/us.png" alt="image">
                                    <h5 class="title">
                                        GIÁ CẢ HỢP LÝ
                                    </h5>
                                    <p class="describe">
                                        Giá cả hợp lý phù hợp tất cả đối tượng khách hàng khác nhau.
                                    </p>
                                </div>
                                <div class="why-change-us-left">
                                    <img src="./image/us.png" alt="image">
                                    <h5 class="title">
                                        PHỤC KHẨN CẤP 24/7
                                    </h5>
                                    <p class="describe">
                                        Đội ngũ bác sĩ luôn thường trực cấp cứu các trường hợp khẩn cấp.
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
                            <?php $i_sevice = 0 ?>
                            <?php foreach ($result_sevice as $key => $value) { ?>
                                <div class="service-us-left col-3">
                                    <a href="./service-chil.php?id= <?php echo $value->id ?>"><img src="<?php echo $value->image ?>" alt=""></a>
                                    <a href="./service-chil.php?id= <?php echo $value->id ?>">
                                        <h4><?php echo $value->title ?></h4>
                                    </a>
                                    <div class="p"><?php echo $value->content ?></div>
                                </div>
                                <?php if (++$i_sevice == 6) break ?>
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
                <p class="title-booking">Đăng ký lịch hẹn khám tại My Pet</p>
                <i class="booking-close fas fa-times"></i>
            </div>
            <div class="line-2">
                <div class="group-booking">
                    <input id="fullname" type="text" placeholder="Họ tên" name="name">
                    <p class="booking-message"></p>
                </div>
                <div class="group-booking">
                    <input id="phone" type="text" placeholder="Điện thoại" name="phone">
                    <p class="booking-message"></p>
                </div>
            </div>
            <div class="line-3">
                <div class="group-booking">
                    <input id="email" type="email" placeholder="Email" name="email">
                    <p class="booking-message"></p>
                </div>
                <div class="group-booking">
                    <input id="date-time" type="date" placeholder="Ngày" name="date">
                    <p class="booking-message"></p>
                </div>
            </div>
            <div class="line-4">
                <div class="group-booking">
                    <select name="select" id="select-booking">
                        <option value="">--Lựa chọn dịch vụ--</option>
                        <?php foreach ($result_sevice as $key => $value) { ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->title ?></option>
                        <?php } ?>
                    </select>
                    <p class="booking-message"></p>
                </div>
            </div>
            <div class="line-5">
                <div class="group-booking">
                    <textarea id="desc" class="decs" name="desc" cols="30" rows="10" placeholder="Nội dung yêu cầu"></textarea>
                    <p class="booking-message"></p>
                </div>
            </div>
            <div class="line-6">
                <div class="group-booking">
                    <input type="submit" value="Đăng ký ngay" name="btn btn-register">
                </div>
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
                            <a href="./news-chil.php?id= <?php echo $value->id ?>"><img src="<?php echo $value->image ?>" alt="" class="post-img"></a>
                            <a href="./news-chil.php?id= <?php echo $value->id ?>">
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
            <?php $i_shop = 0; ?>
            <div class="row pet-show-in">
                <?php foreach ($result_shop as $key => $value) { ?>
                    <div class="col-3 pet-shop-chil">
                        <div class="pet-shop-chil-in">
                            <a href="detail.php?id_shop=<?php echo $value->id_shop ?>"><img src="<?php echo $value->image ?>" alt="image" class="pet-shop-img"></a>
                            <a class="pet-shop-title" href="detail.php?id_shop=<?php echo $value->id_shop ?>"><?php echo $value->title ?></a>
                            <?php if ($value->promotion > 0) { ?>
                                <div class="promotion-div">
                                    <h5 class="price-promotion"><?php echo $value->price ?> VNĐ</h5>
                                    <h5 class="price-product price-product-promo"><?php echo $value->promotion ?> VNĐ</h5>
                                </div>
                                <div class="promotion-img">
                                    <img src="./image/sale.png" alt="sale" class="sale-promotion">
                                </div>
                            <?php } else { ?>
                                <h5 class="price-product"><?php echo $value->price ?> VNĐ</h5>
                            <?php } ?>
                            <div class="more">
                                <a href="detail.php?id_shop=<?php echo $value->id_shop ?>">
                                    <p>Xem thêm <i class="fas fa-angle-double-right"></i></p>
                                </a>
                            </div>
                            <div class="icon-buy">
                                <i class="buy fas fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <?php if (++$i_shop == 8) break ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="newws">
        <div class="container">
            <div class="title-news">
                <div class="logo">
                    <img src="./image/logo-pethealth.png" alt="logo">
                </div>
                <h1>Tin tức Pet shop</h1>
            </div>
            <div class="row">
                <?php $i_news = 0 ?>
                <?php foreach ($result_news as $key => $value) { ?>
                    <div class="col-6 news-chil">
                        <div class="news-chil-image">
                            <a href="./news-chil.php?id= <?php echo $value->id ?>"><img src="<?php echo $value->image ?>" alt="image"></a>
                        </div>
                        <div class="news-chil-title">
                            <a href="./news-chil.php?id= <?php echo $value->id ?>">
                                <h1><?php echo $value->title ?></h1>
                            </a>
                            <div class="desc-p"><?php echo $value->content ?></div>
                        </div>
                    </div>
                    <?php if (++$i_news == 8) break ?>
                <?php } ?>
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
            form: '.form-booking-chil',
            formGroupSelector: '.group-booking',
            errorSelector: ".booking-message",
            rules: [
                Validator.isRequired('#fullname', 'Vui lòng nhập đầy đủ họ tên!'),
                Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại!'),
                Validator.isPhone('#phone', 'Số điện thoại gồm 10 số và bắt đầu từ số 0'),
                Validator.isRequired('#email', 'Vui lòng nhập địa chỉ mail!'),
                Validator.isEmail('#email'),
                Validator.isRequired('#date-time', 'Vui lòng lựa chọn ngày!'),
                Validator.isRequired('#select-booking', 'Vui lòng lựa chọn dịch vụ!'),
                Validator.isRequired('#desc', 'Vui lòng nhập nội dung!'),
            ],
        });
    </script>
</body>

</html>