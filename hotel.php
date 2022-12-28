<?php
include './include/config.php';

if (!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)) {
    $_SESSION['product_filter'] = $_POST;
    // header('Location:petshop.php');exit;
}
if (!empty($_SESSION['product_filter'])) {
    $where = "";
    foreach ($_SESSION['product_filter'] as $field => $value) {
        if (!empty($value)) {
            switch ($field) {
                case 'title':
                    $where = (!empty($where)) ? " AND " . "`" . $field . "` LIKE '%" . $value . "%'" : "`" . $field . "` LIKE '%" . $value . "%'";
                    break;
            }
        }
    }
    extract($_SESSION['product_filter']); //Tạo ra các biến từ mảng
}

$sql = "SELECT * FROM hotel WHERE status_hotel = 1 LIMIT 1";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);

//news new
if (!empty($where)) {
    $sql_news1 = "SELECT * FROM news  WHERE (" . $where . ") AND status_news = 1 LiMIT 12 ";
} else {
    $sql_news1 = "SELECT * FROM news  WHERE status_news = 1 LiMIT 12 ";
}
$query_news1 = $conn->prepare($sql_news1);
$query_news1->execute();
$result_news1 = $query_news1->fetchAll(PDO::FETCH_OBJ);

// sevice
$sql_sevice = "SELECT * FROM sevice WHERE status_sevice = 1";
$query_sevice = $conn->prepare($sql_sevice);
$query_sevice->execute();
$result_sevice = $query_sevice->fetchAll(PDO::FETCH_OBJ);

$success_booking = "";
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['name'])) {
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
    <div class="main-service-chil">
        <div class="slider-service sevice-sevice">
            <img src="./image/home.jpg" alt="slider">
            <h2 class="sevice-h2">Dịch vụ</h2>
            <h1 class="service-h1"><?php echo $result->title ?></h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-8 post-all-service">
                    <div class="post-hotel">
                        <?php echo $result->content ?>
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
                </div>
                <div class="col-4 right-service">
                    <form action="hotel.php?action=search" method="POST">
                        <div class="search search-service">
                            <input type="text" name="title" value="<?= !empty($title) ? $title : "" ?>" placeholder="Tìm kiếm">
                            <input class="icon" name="btn-search" type="submit" value="Tìm" id="">
                        </div>
                    </form>
                    <h1>bài viết mới nhất</h1>
                    <div class="title-news-service">
                        <?php foreach ($result_news1 as $key => $value) { ?>
                            <div class="title-news-service-chil">
                                <div class="news-service-chil">
                                    <a href="news-chil.php?id=<?php echo $value->id ?>"><img src="<?php echo $value->image ?>" alt="image"></a>
                                    <a class="desc" href="news-chil.php?id=<?php echo $value->id ?>"><?php echo $value->title ?></a>
                                </div>
                                <div class="line"></div>
                            </div>
                        <?php } ?>
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