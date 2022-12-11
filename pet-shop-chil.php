<?php
include './include/config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM shop a join category_shop b ON a.id_category = b.id WHERE b.id = $id and a.status_shop = 1";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_category = "SELECT * FROM category_shop WHERE $id = id  AND status_category_shop = 1";
    $query_category = $conn->prepare($sql_category);
    $query_category->execute();
    $result_category = $query_category->fetch(PDO::FETCH_OBJ);
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
        <div class="slider-service">
            <img src="<?php echo $result_category->slider ?>" alt="slider">
            <h2 class="news-h2 pet-shop-h2">Cửa hàng</h2>
            <h1 class="service-h1 pet-shop-h1"><?php echo $result_category->category_title ?></h1>
        </div>
        <div class="container">
            <div class="home-product">
                <div class="home-product-left">
                    <a href="#" class="back-home"><i class="fas fa-home"></i></a>
                    <i class="fas fa-angle-double-right"></i>
                    <a class="product-home" href="#">Phụ kiện thú cưng</a>
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
                <?php foreach ($result as $key => $value) { ?>
                    <div class="col-3 pet-product-chil">
                        <div class="pet-shop-product">
                            <a href="#"><img src="<?php echo $value->image ?>" alt="" class="pet-shop-img"></a>
                            <a class="pet-shop-title" href="#"><?php echo $value->title ?></a>
                            <?php if ($value->promotion > 0) { ?>
                                <div class="promotion-div">
                                    <h5 class="price-promotion"><?php echo $value->price ?> VNĐ</h5>
                                    <h5 class="price-product price-product-promo"><?php echo $value->promotion ?> VNĐ</h5>
                                </div>
                                <img src="./image/sale.png" alt="sale" class="sale-promotion">
                            <?php } else { ?>
                                <h5 class="price-product"><?php echo $value->price ?> VNĐ</h5>
                            <?php } ?>
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
        </div>
    </div>
    <!-- footer  -->
    <?php
    include "./include/footer.php";
    ?>
    <!-- /footer  -->
</body>

</html>