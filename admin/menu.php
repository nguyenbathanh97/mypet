<?php
include "../include/config.php";
$sqlSl_user = "SELECT * FROM admin";
$query_user = $conn->prepare($sqlSl_user);
$query_user->execute();
$result_user = $query_user->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href='//fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="../lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main-menu">
        <div class="menu-top">
            <div class="title">
                <h1>Trang quản lý MYPET</h1>
            </div>
        </div>
        <div class="menu-left">
            <div class="menu-show-all">
                <div class='menu-toogle' title="Hiện Menu">
                    <div class='line_one'></div>
                    <div class='line_two'></div>
                    <div class='line_three'></div>
                </div>
            </div>
            <div class='dark'>
            </div>
            <div id='navigator'>
                <div class="section1">
                    <ul>
                        <li><a href="../index.php"><i class="material-icons fas fa-home"></i><span>Trang chủ</span></a>
                        </li>
                        <li><a href="./slider.php"><i class="material-icons fab fa-slideshare"></i><span>Slider</span></a>
                        </li>
                        <li><a href="./infor.php"><i class="material-icons fas fa-info-circle"></i><span>Giới thiệu</span></a>
                        </li>
                        <li><a href="./sevice.php"><i class="material-icons fas fa-suitcase-rolling"></i><span>Dịch vụ</span></a>
                        </li>
                        <li><a href="./sevice.php"><i class="material-icons fas fa-store"></i><span>Cửa hàng</span></a>
                        </li>
                        <li><a href="./hotel.php"><i class="material-icons fas fa-hotel"></i><span>Khách sạn</span></a>
                        </li>
                        <li><a href="./news.php"><i class="material-icons fas fa-newspaper"></i><span>Tin tức</span></a>
                        </li>
                        <li><a href="./contact.php"><i class="material-icons fas fa-address-book"></i><span>Liên hệ</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="menu-right">
            <h5 class="name-user">
                Xin chào: <span><?php echo $result_user->name ?></span>
            </h5>
            <a class="img-user" href="#">
                <img src="../image/avatar.png" alt="image">
            </a>
            <div class="drop-down-user">
                <i class="down-click fas fa-sort-down"></i>
                <div class="down-logout">
                    <a class="logout" href="./login.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="./js/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="main-menu.js"></script>
</body>

</html>