<?php
include 'config.php';
$sql_header = "SELECT * FROM sevice WHERE status_sevice = 1";
$query_header = $conn->prepare($sql_header);
$query_header->execute();
$result_header = $query_header->fetchAll(PDO::FETCH_OBJ);

$sql_header_shop = "SELECT * FROM category_shop WHERE status_category_shop = 1";
$query_header_shop = $conn->prepare($sql_header_shop);
$query_header_shop->execute();
$result_header_shop = $query_header_shop->fetchAll(PDO::FETCH_OBJ);

if (isset($_SESSION['logins']['id'])) {
    $change = $_SESSION['logins']['id'];
    $sql_setting = "SELECT * FROM user  WHERE id = $change";
    $query_setting = $conn->prepare($sql_setting);
    $query_setting->execute();
    $result_setting = $query_setting->fetch(PDO::FETCH_OBJ);
}

if (isset($_SESSION['logins']['id'])) {
    $change = $_SESSION['logins']['id'];
    $sql_setting = "SELECT * FROM user  WHERE id = $change";
    $query_setting = $conn->prepare($sql_setting);
    $query_setting->execute();
    $result_setting = $query_setting->fetch(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./lib/Bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="header-fa">
        <div class="container">
            <div class="header">
                <div class="infor-header">
                    <div class="infor">
                        <a href="#" class="address">Số 100, Đậu Yên, Trung Đô, TP Vinh, Nghệ An</a>
                        <span>|</span>
                        <a href="#" class="time"><i class="far fa-clock"></i> 08:00 - 20:00 (Trực cấp cứu 24/7)</a>
                        <span>|</span>
                        <a href="tel:0988838275" class="phone"><i class="fas fa-phone"></i> 0988838275</a>
                    </div>
                    <div class="search">
                        <input type="text" placeholder="Tìm kiếm">
                        <div class="icon">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <div class="login-header">
                        <div class="login-user">
                            <?php if (isset($_SESSION['logins']['username'])) { ?>
                            <img src="<?php echo $result_setting->image ?>" alt="image">
                            <span><?php echo $_SESSION['logins']['name'] ?></span>
                            <?php } else { ?>
                            <div class="login-register">
                                <span><a href="register.php">Đăng ký</a> / <a href="login.php">Đăng
                                        nhập</a></span>
                            </div>
                            <?php } ?>
                            <div class="down-icon">
                                <?php if (isset($_SESSION['logins']['username'])) { ?>
                                <div class="icon-down">
                                    <i class="fas fa-caret-down"></i>
                                </div>
                                <div class="login-down">
                                    <ul>
                                        <li><a class="infor-form" href="setting.php">Thông tin</a></li>
                                        <?php if (isset($_SESSION['logins']['status'])) { ?>
                                        <?php $test = $_SESSION['logins']['status'] ?>
                                        <?php if ($test == 1) { ?>
                                        <li><a href="admin/control.php">Trang quản trị</a></li>
                                        <?php } ?>
                                        <?php } ?>
                                        <li><a href="infor_cart.php">Đơn hàng của bạn</a></li>
                                        <li><a href="logout.php">Đăng xuất</a> </li>
                                    </ul>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-header">
                    <a href="#" class="logo">
                        <img src="./image/logo.png" alt="logo">
                    </a>
                    <div class="menu">
                        <ul>
                            <li><a href="index.php">Trang chủ</a></li>
                            <li><a href="information.php">Giới thiệu</a></li>
                            <li><a href="service.php">Dịch vụ <i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <?php foreach ($result_header as $key => $value) { ?>
                                    <li><a
                                            href="service-chil.php?id=<?php echo $value->id ?>"><?php echo $value->title ?></a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li><a href="petshop.php">Pet shop <i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <?php foreach ($result_header_shop as $key => $value) { ?>
                                    <li><a
                                            href="pet-shop-chil.php?id=<?php echo $value->id ?>"><?php echo $value->category_title ?></a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li><a href="hotel.php">Khách sạn</a>
                            </li>
                            <li><a href="news.php">Tin tức</a></li>
                            <li><a href="contact.php">Liên hệ</a></li>
                            <?php if (isset($_SESSION['logins']['id'])) { ?>
                            <li><a class="cart-li" href="cart.php">
                                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) >= 1) { ?>
                                    <div class="cart-number">
                                        <span>
                                            <?php echo count($_SESSION['cart']) ?>
                                        </span>
                                    </div>
                                    <?php } ?>
                                    <img src="./image/add-to-cart.png" alt="image">
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="backtop">
        <i class="fas fa-arrow-up"></i>
    </div>
</body>

</html>