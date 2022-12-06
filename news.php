<?php
include './include/config.php';
$sql_news = "SELECT * FROM news";
$query_news = $conn->prepare($sql_news);
$query_news->execute();
$result_news = $query_news->fetchAll(PDO::FETCH_OBJ);
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
                            <a href="news-chil.php?id=<?php echo $value->id ?>"><img src="<?php echo $value->image ?>" alt="image"></a>
                            <div class="time">
                                <h5><?php echo $value->date ?></h5>
                            </div>
                            <div class="service-title">
                                <a href="news-chil.php?id=<?php echo $value->id ?>">
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
                        <?php foreach ($result_news as $key => $value) { ?>
                            <div class="title-news-service-chil">
                                <div class="news-service-chil">
                                    <a href="news-chil.php?id=<?php echo $value->id ?>"><img src="<?php echo $value->image ?>" alt="image"></a>
                                    <a class="desc" href="news-chil.php?id=<?php echo $value->id ?>"><?php echo $value->title ?></a>
                                </div>
                                <div class="line"></div>
                            </div>
                        <?php } ?>
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