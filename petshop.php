<?php
include './include/config.php';
//  shop
// $sql_shop = "SELECT * FROM shop WHERE status_shop = 1";
// $query_shop = $conn->prepare($sql_shop);
// $query_shop->execute();
// $result_shop = $query_shop->fetchAll(PDO::FETCH_OBJ);

//page
$page = 1;
$limit = 10;
$start = ($page-1) * $limit;

$sql_pet = "SELECT * FROM shop a join category_shop b on a.id_category = b.id  WHERE status_shop = 1";
$query_pet = $conn->prepare($sql_pet);
$query_pet->execute();
$result_pet = $query_pet->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet shop</title>
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
                <div class="home-back-pet-shop">
                    <a href="#" class="back-home"><i class="fas fa-home"></i></a>
                    <i class="next-icon-product fas fa-angle-double-right"></i>
                    <a class="product-home" href="#">Cửa hàng thú cưng</a>
                </div>
                <div class="home-product-right">
                    <i class="filter fas fa-filter"></i>
                    <select class="select" name="" id="">
                        <option value="0">Mới nhất</option>
                        <option value="1">Giá thấp</option>
                        <option value="2">Giá cao</option>
                    </select>
                </div>
            </div>
            <div class="row pet-product">
                <?php foreach ($result_pet as $key => $value) { ?>
                    <div class="col-3 pet-product-chil">
                        <div class="pet-shop-product">
                            <a href="detail.php?id_shop=<?php echo $value->id_shop ?>"><img src="<?php echo $value->image ?>" alt="" class="pet-shop-img"></a>
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