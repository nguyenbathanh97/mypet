<?php
include '../include/config.php';
// if(isset($id)){
//     $sqlSl_user = "SELECT * FROM admin where id = :id";
//     $query_user = $conn->prepare($sqlSl_user);
//     $query_user -> bindParam(':id', $id, PDO::PARAM_STR);
//     $query_user->execute();
//     $result_user = $query_user->fetch(PDO::FETCH_OBJ);
// }
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css-admin/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./css-admin/style.css">
</head>

<body>
    <div class="main-menu">
        <div class="main-menu-all">
            <div class="menu-top-left">
                <h1>Trang quản lý MYPET</h1>
            </div>
            <div class="menu-right">
                <h5 class="name-user">
                    Xin chào: <span><?php echo $_SESSION['logins']['name'] ?></span>
                </h5>
                <a class="img-user" href="#">
                    <img src="../image/logo-top.jpg" alt="image">
                </a>
                <div class="drop-down-user">
                    <i class="down-click fas fa-sort-down"></i>
                    <div class="down-logout">
                        <a class="logout" href="../logout.php">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-left">
            <div id='navigator'>
                <div class="section1">
                    <ul>
                        <li><a href="../index.php"><i class="material-icons fas fa-home"></i><span>Trang chủ</span></a>
                        </li>
                        <li><a href="./control.php"><i class="material-icons fab fa-elementor"></i><span>Bảng điều
                                    khiển</span></a>
                        </li>
                        <li><a href="./slider.php"><i
                                    class="material-icons fab fa-slideshare"></i><span>Slider</span></a>
                        </li>
                        <li class="menu-li-par"><a href="#"><i class="material-icons fas fa-info-circle"></i><span>Thông
                                    tin</span><i class="down-shop-i fas fa-chevron-down"></i></a>
                            <ul id="menu-chil-ul">
                                <li class="menu-chil-li"><a href="./infor.php"><i
                                            class="fas fa-info-circle"></i><span>Giới thiệu</span></a></li>
                                <li class="menu-chil-li"><a href="./sevice.php"><i
                                            class="fas fa-suitcase-rolling"></i><span>Dịch vụ</span></a></li>
                                <li class="menu-chil-li"><a href="./hotel.php"><i class=" fas fa-hotel"></i><span>Khách
                                            sạn</span></a></li>
                            </ul>
                        </li>
                        <li><a href="./news.php"><i class="material-icons fas fa-newspaper"></i><span>Tin tức</span></a>
                        </li>
                        <li class="menu-li-par1"><a href="#"><i class="material-icons fas fa-store"></i><span>Cửa
                                    hàng</span><i class="down-shop-i1 fas fa-chevron-down"></i></a>
                            <ul id="menu-chil-ul1">
                                <li class="menu-chil-li"><a href="./category-shop.php"><i
                                            class="fas fa-stream"></i><span>Danh mục</span></a></li>
                                <li class="menu-chil-li"><a href="./pet-shop.php"><i class="fas fa-gifts"></i><span>Sản
                                            phẩm</span></a></li>
                                <li class="menu-chil-li"><a href="./comment.php"><i
                                            class="fas fa-comments"></i><span>Đánh giá</span></a></li>
                            </ul>
                        </li>
                        <li><a href="./contact.php"><i class="material-icons fas fa-address-book"></i><span>Liên
                                    hệ</span></a>
                        <li><a href="./employee.php"><i class="material-icons fas fa-user-md"></i><span>Nhân
                                    viên</span></a>
                        </li>
                        <li><a href="./calendar.php"><i class="material-icons fas fa-calendar-alt"></i><span>Lịch
                                    biểu</span></a>
                        </li>
                        <li><a href="./booking.php"><i class="material-icons fas fa-book"></i><span>Lịch đặt</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="backtop">
        <i class="fas fa-arrow-up"></i>
    </div> -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="./js/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="./js-admin/main-menu.js"></script>
</body>

</html>