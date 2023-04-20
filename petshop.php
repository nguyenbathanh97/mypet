<?php
include './include/config.php';
//  shop
// $sql_shop = "SELECT * FROM shop WHERE status_shop = 1";
// $query_shop = $conn->prepare($sql_shop);
// $query_shop->execute();
// $result_shop = $query_shop->fetchAll(PDO::FETCH_OBJ);
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
    // var_dump($where);
    // die();
}
//page
$page = !empty($_GET['per_page']) ? $_GET['per_page'] : 12;
$current_page = !empty($_GET['page']) ? $_GET['page'] : 1; //Trang hien tai
$offset = ($current_page - 1) * $page;
if (!empty($where)) {
    $sql_pet = "SELECT * FROM shop a join category_shop b on a.id_category = b.id WHERE (" . $where . ") AND a.status_shop=1  ORDER BY 'id_shop' ASC LIMIT " . $page . " OFFSET " . $offset . "";
} else {
    $sql_pet = "SELECT * FROM shop a join category_shop b on a.id_category = b.id WHERE a.status_shop=1 ORDER BY 'id_shop' ASC LIMIT " . $page . " OFFSET " . $offset . "";
}
$query_pet = $conn->prepare($sql_pet);
$query_pet->execute();
$result_pet = $query_pet->fetchAll(PDO::FETCH_OBJ);
$total_product = "SELECT count(*) FROM shop WHERE status_shop=1";
$query_total = $conn->prepare($total_product);
$query_total->execute();
$result_total = $query_total->fetchColumn();
// var_dump($result_total);
// die();
$total_page = ceil($result_total / $page);
// var_dump($total_page);
// die();
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
                <form action="petshop.php?action=search" method="POST">
                    <div class="home-product-right">
                        <fieldset class="fiel">
                            <legend>Tìm kiếm sản phẩm:</legend>
                            <i class="filter fas fa-filter"></i>
                            <input type="text" name="title" class="search-input"
                                value="<?= !empty($title) ? $title : "" ?>">
                            <input type="submit" name="btn-order-by" value="Tìm kiếm" class="price-order-by">
                        </fieldset>
                    </div>
                </form>
            </div>
            <div class="row pet-product">
                <?php foreach ($result_pet as $key => $value) { ?>
                <div class="col-3 pet-product-chil">
                    <div class="pet-shop-product">
                        <a href="detail.php?id_shop=<?php echo $value->id_shop ?>"><img
                                src="<?php echo $value->image ?>" alt="" class="pet-shop-img"></a>
                        <a class="pet-shop-title"
                            href="detail.php?id_shop=<?php echo $value->id_shop ?>"><?php echo $value->title ?></a>
                        <?php if ($value->promotion > 0) { ?>
                        <div class="promotion-div">
                            <h5 class="price-promotion"><?php echo number_format($value->price, 0, ",", ".") ?> VNĐ</h5>
                            <h5 class="price-product price-product-promo">
                                <?php echo number_format($value->promotion, 0, ",", ".") ?> VNĐ</h5>
                        </div>
                        <div class="promotion-img">
                            <img src="./image/sale.png" alt="sale" class="sale-promotion">
                        </div>
                        <?php } else { ?>
                        <h5 class="price-product"><?php echo number_format($value->price, 0, ",", ".") ?> VNĐ</h5>
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
            <?php include "./page/page.php"; ?>
        </div>

    </div>
    <!-- footer  -->
    <?php
    include "./include/footer.php";
    ?>
    <!-- /footer  -->
</body>

</html>