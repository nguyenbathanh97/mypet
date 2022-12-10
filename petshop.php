<?php
include './include/config.php';
//  shop
$sql_shop = "SELECT * FROM shop WHERE status_shop = 1";
$query_shop = $conn->prepare($sql_shop);
$query_shop->execute();
$result_shop = $query_shop->fetchAll(PDO::FETCH_OBJ);
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
            <img src="./image/slider-product.jpg" alt="slider">
            <h1 class="service-h1 product-h1">Cửa hàng thú cưng</h1>
        </div>
        <div class="container">
            <div class="home-product">
                <a href="#" class="back-home"><i class="fas fa-home"></i></a>
                <i class="next-icon-product fas fa-angle-double-right"></i>
                <a class="product-home" href="#">Cửa hàng thú cưng</a>
            </div>
            <div class="row pet-product">
                <?php foreach ($result_shop as $key => $value) { ?>
                    <div class="col-3 pet-product-chil">
                        <div class="pet-shop-product">
                            <a href="#"><img src="<?php echo $value->image ?>" alt="" class="pet-shop-img"></a>
                            <a class="pet-shop-title" href="#"><?php echo $value->title ?></a>
                            <h5 class="price-product"><?php echo $value->price ?></h5>
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
                <?php } ?>
            </div>
            <div class="show-more-product">
                <a href="#">Xem thêm</a>
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