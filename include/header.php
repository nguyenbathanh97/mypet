<?php
include 'config.php';
$sql_header = "SELECT * FROM sevice";
$query_header = $conn->prepare($sql_header);
$query_header->execute();
$result_header = $query_header->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./lib/Bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                </div>
                <div class="menu-header">
                    <a href="#" class="logo">
                        <img src="./image/avatar-footer.png" alt="logo">
                    </a>
                    <div class="menu">
                        <ul>
                            <li><a href="index.php">Trang chủ</a></li>
                            <li><a href="information.php">Giới thiệu</a></li>
                            <li><a href="service.php">Dịch vụ <i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <?php foreach ($result_header as $key => $value) { ?>
                                        <li><a href="service-chil.php?id=<?php echo $value->id ?>"><?php echo $value->title ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li><a href="petshop.php">Pet shop <i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li><a href="pet-shop-chil.php">thức ăn, dinh dưỡng</a></li>
                                    <li><a href="pet-shop-chil.php">Nhà chuồng nệm</a></li>
                                    <li><a href="pet-shop-chil.php">Phụ kiện thú cưng</a></li>
                                    <li><a href="pet-shop-chil.php">Thời trang thú cưng</a></li>
                                </ul>
                            </li>
                            <li><a href="hotel.php">Khách sạn</a>
                            </li>
                            <li><a href="news.php">Tin tức</a></li>
                            <li><a href="contact.php">Liên hệ</a></li>
                            <li><a href="#"><i class="header-bag fas fa-shopping-bag"></i></a>
                                <ul>
                                    <li><a href="#">Giỏ hàng</a></li>
                                </ul>
                            </li>
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