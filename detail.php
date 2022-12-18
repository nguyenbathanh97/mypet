<?php
include './include/config.php';

if (isset($_GET['id_shop'])) {
    $id = $_GET['id_shop'];
    $sql_pet = "SELECT * FROM shop a join category_shop b on a.id_category = b.id WHERE a.id_shop = $id";
    $query_pet = $conn->prepare($sql_pet);
    $query_pet->execute();
    $result_pet = $query_pet->fetch(PDO::FETCH_OBJ);
}
$show = $result_pet->id;
// var_dump($show);
// die();


if (isset($_GET['id_shop'])) {
    $id = $_GET['id_shop'];
    // var_dump($id);
    // die();
    $sql_cmt = "SELECT * FROM comment a join shop b on a.id_shop_fk = b.id_shop WHERE $id = a.id_shop_fk";
    $result_cmt = $conn->prepare($sql_cmt);
    $result_cmt->execute();
    $result_cmt_ex = $result_cmt->fetchAll(PDO::FETCH_OBJ);
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $content_comment = $_POST['content_comment'];
        $sql = "INSERT INTO comment (name, content_comment, id_shop_fk) VALUES (:name, :content_comment, :id)";
        $query_comment = $conn->prepare($sql);
        $query_comment->bindParam(':name', $name, PDO::PARAM_STR);
        $query_comment->bindParam(':content_comment', $content_comment, PDO::PARAM_STR);
        $query_comment->bindParam(':id', $id, PDO::PARAM_STR);
        $query_comment_ex = $query_comment->execute();
        if(($query_comment_ex)){
            header("location: ./detail.php?id_shop=$result_pet->id_shop");
        }
    }
}

$sql_shop = "SELECT * FROM shop a join category_shop b on a.id_category = b.id WHERE b.id = $show  ";
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
    <title>Chi tiết</title>
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
    <div class="main-detail">
        <div class="container">
            <div class="detail-product">
                <div class="detail-product-img">
                    <img src="<?php echo $result_pet->image ?>" alt="image">
                </div>
                <div class="detail-product-detail">
                    <div class="detail-back-home">
                        <a href="./index.php">Trang chủ</a>
                        <span>/</span>
                        <a href="#"><?php echo $result_pet->category_title ?></a>
                    </div>
                    <h5 class="detail-title"><?php echo $result_pet->title ?></h5>
                    <div class="detail-line"></div>
                    <div class="detail-price">
                        <?php if ($result_pet->promotion > 0) { ?>
                            <p class="price price-desc"><?php echo $result_pet->price ?> VNĐ</p>
                            <p class="promotion"><?php echo $result_pet->promotion ?> VNĐ</p>
                            <div class="promotion-img-detail">
                                <img src="./image/sale.png" alt="sale" class="sale-promotion-detail">
                            </div>
                        <?php } else { ?>
                            <p class="promotion"><?php echo $result_pet->price ?> VNĐ</p>
                        <?php } ?>
                    </div>
                    <div class="number-product">
                        <div class="buttons_added">
                            <input class="minus is-form" type="button" value="-">
                            <input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" value="1">
                            <input class="plus is-form" type="button" value="+">
                        </div>
                        <div class="btn-add-store">
                            <input type="submit" value="Thêm vào giỏi hàng">
                        </div>
                    </div>
                    <div class="detail-line-under"></div>
                    <div class="contact-title">
                        <h5>Liên hệ:</h5>
                    </div>
                    <div class="contact-detail">
                        <a target="_blank" href="https://www.facebook.com/ThanhMBlue/" class="facebook"><i class="fab fa-facebook"></i></a>
                        <a target="_blank" href="https://www.facebook.com/ThanhMBlue/" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a target="_blank" href="https://www.facebook.com/ThanhMBlue/" class="email"><i class="fas fa-at"></i></a>
                        <a target="_blank" href="https://www.facebook.com/ThanhMBlue/" class="instargam"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" href="https://www.facebook.com/ThanhMBlue/" class="google"><i class="fab fa-google-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="detail-content">
                <div class="line-under"></div>
                <div class="desc-title-content">Mô tả</div>
                <h5 class="detail-content-h5"><?php echo $result_pet->content ?></h5>
            </div>
        </div>
        <div class="container">
            <div class="detail-similar">
                <div class="line-under"></div>
                <div class="desc-title-content">Sản phẩm tương tự</div>
                <div class="row similer-flex">
                    <div class="row">
                        <div class="slider-show-similar-pre">
                            <?php foreach ($result_shop as $key => $value) { ?>
                                <div class="slider-show-similar">
                                    <a href="detail.php?id_shop=<?php echo $value->id_shop ?>" class="img-similar"><img src="<?php echo $value->image ?>" alt="image"></a>
                                    <div class="slider-show-similar-under">
                                        <a href="detail.php?id_shop=<?php echo $value->id_shop ?>" class="title-similar"><?php echo $value->title ?></a>
                                        <div class="price-similar">
                                            <?php if ($value->promotion > 0) { ?>
                                                <p class="price price-desc"><?php echo $value->price ?> VNĐ</p>
                                                <p class="promotion-desc"><?php echo $value->promotion ?> VNĐ</p>
                                                <div class="promotion-img-detail-under">
                                                    <img src="./image/sale.png" alt="sale" class="sale-promotion-detail">
                                                </div>
                                            <?php } else { ?>
                                                <p class="promotion"><?php echo $value->price ?> VNĐ</p>
                                            <?php } ?>
                                        </div>
                                        <div class="buy-similar">
                                            <div class="icon-buy">
                                                <a href="#"><i class="buy fas fa-shopping-cart"></i></a>
                                            </div>
                                            <div class="more">
                                                <a href="detail.php?id_shop=<?php echo $value->id_shop ?>">
                                                    <p>Xem thêm <i class="fas fa-angle-double-right"></i></p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="comment-detail">
                <div class="line-comment"></div>
                <h5>Bình luận</h5>
                <form action="" method="POST" id="form-comment">
                    <div class="group-comment">
                        <input type="text" name="name" id="name-comment-input" class="name-comment-input" placeholder="Họ tên">
                        <p id="display-commnet-message"></p>
                    </div>
                    <div class="group-comment">
                        <textarea class="comment-text" placeholder="Nội dung" name="content_comment" id="comment-text" cols="30" rows="10"></textarea>
                        <p id="display-commnet-message"></p>
                    </div>
                    <div class="button-comment">
                        <input type="submit" name="btn-comment" value="Bình luận" id="btn-comment" class="btn-comment">
                    </div>
                </form>
                <?php foreach ($result_cmt_ex as $key => $value) { ?>
                    <div class="comment">
                    <div class="avatar-comment">
                        <a href="#">
                            <img src="./image/avatar-comment.jpg" alt="image">
                        </a>
                    </div>
                    <div class="display-comment">
                        <h5 class="name-comment"><?php echo $value->name ?></h5>
                        <p><?php echo $value->content_comment ?></p>
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
<script src="./js/validator.js"></script>
<script>
    Validator({
        form: '#form-comment',
        formGroupSelector: '.group-comment',
        errorSelector: "#display-commnet-message",
        rules: [
            Validator.isRequired('#name-comment-input', 'Vui lòng nhập đầy đủ họ tên!'),
            Validator.isRequired('#comment-text', 'Vui lòng nhập nội dung!'),
        ],
    });
</script>

</html>