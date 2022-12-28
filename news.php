<?php
include './include/config.php';
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
}
//news new
if (!empty($where)) {
    $sql_news1 = "SELECT * FROM news  WHERE (".$where.") AND status_news = 1 LiMIT 12 ";
} else {
    $sql_news1 = "SELECT * FROM news  WHERE status_news = 1 LiMIT 12 ";
}
$query_news1 = $conn->prepare($sql_news1);
$query_news1->execute();
$result_news1 = $query_news1->fetchAll(PDO::FETCH_OBJ);

//list news
$page = !empty($_GET['per_page']) ? $_GET['per_page'] : 5;
$current_page = !empty($_GET['page']) ? $_GET['page'] : 1; //Trang hien tai
$offset = ($current_page - 1) * $page;
$sql_news = "SELECT * FROM news  WHERE status_news = 1 ORDER BY 'id_news' ASC LIMIT " . $page . " OFFSET " . $offset . "";
$query_news = $conn->prepare($sql_news);
$query_news->execute();
$result_news = $query_news->fetchAll(PDO::FETCH_OBJ);
$total_product = "SELECT count(*) FROM news  WHERE status_news = 1";
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
                    <?php include "./page/page.php" ?>
                </div>
                <div class="col-4 right-service">
                    <form  action="news.php?action=search" method="POST">
                        <div class="search search-service">
                            <input type="text" name="title" value="<?= !empty($title) ? $title : "" ?>" placeholder="Tìm kiếm">
                            <input class="icon" type="submit" value="Tìm" id="">
                        </div>
                    </form>
                    <h1>bài viết mới nhất</h1>
                    <div class="title-news-service">
                        <?php foreach ($result_news1 as $key => $value) { ?>
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