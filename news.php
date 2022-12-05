<?php
include './include/config.php';
$sql = "SELECT * FROM news";
$query = $conn->prepare($sql);
$query->execute();
$result_news = $query->fetchAll(PDO::FETCH_OBJ);
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
    <div class="main-service news">
        <div class="container">
            <h1>Tin tức My Pet</h1>
            <div class="row">
                <div class="col-8">
                    <?php foreach ($result_news as $key => $value) { ?>
                        <div class="service">
                            <a href="#"><img src="<?php echo $value->image ?>" alt="image"></a>
                            <div class="time">
                                <h5><?php echo $value->date ?></h5>
                            </div>
                            <div class="service-title">
                                <a href="#">
                                    <h2 class="title"><?php echo $value->title ?></h2>
                                    <div class="desc"><?php echo $value->content ?></div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-4 right-service">
                    <div class="search search-service">
                        <input type="text" placeholder="Tìm kiếm">
                        <div class="icon">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <h1>bài viết mới nhất</h1>
                    <div class="title-news-service">
                        <div class="title-news-service-chil">
                            <div class="news-service-chil">
                                <a href="#"><img src="./image/khambenh.jpg" alt="image"></a>
                                <a class="desc" href="#">Siêu ưu đãi mổ thú cưng đảm bảo 100% thành công và an toàn Siêu ưu đãi mổ thú cưng đảm bảo 100% thành công và an toàn</a>
                            </div>
                            <div class="line"></div>
                        </div>
                        <div class="title-news-service-chil">
                            <div class="news-service-chil">
                                <a href="#"><img src="./image/khambenh.jpg" alt="image"></a>
                                <a class="desc" href="#">Siêu ưu đãi mổ thú cưng đảm bảo 100% thành công và an toàn Siêu ưu đãi mổ thú cưng đảm bảo 100% thành công và an toàn</a>
                            </div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
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