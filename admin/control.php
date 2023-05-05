<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển</title>
    <link href='//fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="../lib/fontawesome/css/all.min.css">
    <?php
    include "../include/link-css.php";
    ?>
    <link rel="stylesheet" href="./css-admin/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./css-admin/style.css">
</head>

<body>
    <!-- menu  -->
    <?php
    include("menu.php");
    ?>
    <!-- menu  -->
    <div class="main-control">
        <div class="title-control">
            <h1>Bảng điều khiển</h1>
        </div>
        <div class="control-control">
            <div class="container">
                <div class="row">
                    <div class="col-3 margin-under-control">
                        <div class="box-control">
                            <h5>Slider</h5>
                        </div>
                        <div class="box-control-under">
                            <a href="./slider.php"><i class="material-icons fab fa-slideshare"></i></a>
                        </div>
                    </div>
                    <div class="col-3 margin-under-control">
                        <div class="box-control box-control1">
                            <h5>Giới thiệu</h5>
                        </div>
                        <div class="box-control-under">
                            <a href="./infor.php"><i class="material-icons fas fa-info-circle"></i></a>
                        </div>
                    </div>
                    <div class="col-3 margin-under-control">
                        <div class="box-control box-control2">
                            <h5>Dịch vụ</h5>
                        </div>
                        <div class="box-control-under">
                            <a href="./sevice.php"><i class="material-icons fas fa-suitcase-rolling"></i></a>
                        </div>
                    </div>
                    <div class="col-3 margin-under-control">
                        <div class="box-control box-control3">
                            <h5>Cửa hàng</h5>
                        </div>
                        <div class="box-control-under box-control-under-store">
                            <a href="./category-shop.php"><i class="material-icons fas fa-stream"></i></a>
                            <a href="./pet-shop.php"><i class="material-icons fas fa-gifts"></i></a>
                        </div>
                    </div>
                    <div class="col-3 margin-under-control">
                        <div class="box-control">
                            <h5>khách sạn</h5>
                        </div>
                        <div class="box-control-under">
                            <a href="./hotel.php"><i class="material-icons fas fa-hotel"></i></a>
                        </div>
                    </div>
                    <div class="col-3 margin-under-control">
                        <div class="box-control box-control1">
                            <h5>Tin tức</h5>
                        </div>
                        <div class="box-control-under">
                            <a href="./news.php"><i class="material-icons fas fa-newspaper"></i></a>
                        </div>
                    </div>
                    <div class="col-3 margin-under-control">
                        <div class="box-control box-control2">
                            <h5>Liên hệ</h5>
                        </div>
                        <div class="box-control-under">
                            <a href="./contact.php"><i class="material-icons fas fa-address-book"></i></a>
                        </div>
                    </div>
                    <div class="col-3 margin-under-control">
                        <div class="box-control box-control3">
                            <h5>Nhân viên</h5>
                        </div>
                        <div class="box-control-under">
                            <a href="./employee.php"><i class="material-icons fas fa-user-md"></i></a>
                        </div>
                    </div>
                    <div class="col-3 margin-under-control">
                        <div class="box-control">
                            <h5>Lịch biểu</h5>
                        </div>
                        <div class="box-control-under">
                            <a href="./calendar.php"><i class="material-icons fas fa-calendar-alt"></i></a>
                        </div>
                    </div>
                    <div class="col-3 margin-under-control">
                        <div class="box-control box-control1">
                            <h5>Lịch đặt</h5>
                        </div>
                        <div class="box-control-under">
                            <a href="./booking.php"><i class="material-icons fas fa-book"></i></a>
                        </div>
                    </div>
                    <div class="col-3 margin-under-control">
                        <div class="box-control box-control1">
                            <h5>Người dùng</h5>
                        </div>
                        <div class="box-control-under">
                            <a href="#"><i class="fas fa-user-tie"></i></a>
                        </div>
                    </div>
                    <div class="col-3 margin-under-control">
                        <div class="box-control box-control1">
                            <h5>Đơn hàng</h5>
                        </div>
                        <div class="box-control-under box-control">
                            <a href="./order.php"><i class="fas fa-box-open"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="./js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="../lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="./js-admin/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js-admin/main-admin.js"></script>

</html>