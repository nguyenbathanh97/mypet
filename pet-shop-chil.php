<?php
include './include/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION["id"] = $id;
    $id1 = $_SESSION["id"];
    // $sql = "SELECT * FROM shop a join category_shop b ON a.id_category = b.id WHERE b.id = $id and a.status_shop = 1";
    // $query = $conn->prepare($sql);
    // $query->execute();
    // $result = $query->fetchAll(PDO::FETCH_OBJ);
    $page = !empty($_GET['per_page']) ? $_GET['per_page'] : 12;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1; //Trang hien tai
    $offset = ($current_page - 1) * $page;
    $sql_pet = "SELECT * FROM shop a join category_shop b ON a.id_category = b.id WHERE b.id = $id and a.status_shop = 1 ORDER BY a.id_shop ASC  LIMIT " . $page . " OFFSET " . $offset . "";
    $query_pet = $conn->prepare($sql_pet);
    $query_pet->execute();
    $result_pet = $query_pet->fetchAll(PDO::FETCH_OBJ);
    $total_product = "SELECT count(*) FROM shop a join category_shop b ON a.id_category = b.id WHERE b.id = $id and a.status_shop = 1";
    $query_total = $conn->prepare($total_product);
    $query_total->execute();
    $result_total = $query_total->fetchColumn();
    // var_dump($result_total);
    // die();
    $total_page = ceil($result_total / $page);
    // var_dump($total_page);
    // die();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_category = "SELECT * FROM category_shop WHERE id = $id AND status_category_shop = 1";
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
                    <a href="./index.php" class="back-home"><i class="fas fa-home"></i></a>
                    <i class="fas fa-caret-right"></i>
                    <a class="product-home" href="#"><?php echo $result_category->category_title ?></a>
                </div>
                <form action="" method="POST">
                    <div class="home-product-right">
                        <i class="filter fas fa-filter"></i>
                        <select class="select" name="select" id="">
                            <option value="0">Mới nhất</option>
                            <option value="1">Giá thấp</option>
                            <option value="2">Giá cao</option>
                        </select>
                        <input type="submit" name="btn-order-by" value="Sắp xếp" class="price-order-by">
                    </div>
                </form>
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
            <?php include "./page-chil.php"; ?>
        </div>
    </div>
    <!-- footer  -->
    <?php
    include "./include/footer.php";
    ?>
    <!-- /footer  -->
</body>

</html>