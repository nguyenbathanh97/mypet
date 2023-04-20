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
    // var_dump($where);
    // die();
}
//news new
if (!empty($where)) {
    $sql_news = "SELECT * FROM news WHERE (" . $where . ") AND status_news = 1";
} else {
    $sql_news = "SELECT * FROM news WHERE status_news = 1";
}
$query_news = $conn->prepare($sql_news);
$query_news->execute();
$result_news = $query_news->fetchAll(PDO::FETCH_OBJ);
//sevice
$sql = "SELECT * FROM sevice WHERE status_sevice = 1";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);

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
    <div class="main-service">
        <div class="container">
            <h1>Dịch vụ My Pet</h1>
            <div class="row">
                <div class="col-8">
                    <?php foreach ($result as $key => $value) { ?>
                    <div class="service">
                        <a href="service-chil.php?id=<?php echo $value->id ?>"><img src="<?php echo $value->image ?>"
                                alt="image"></a>
                        <div class="service-title">
                            <a href="service-chil.php?id=<?php echo $value->id ?>">
                                <h2 class="title"><?php echo $value->title ?></h2>
                                <div class="desc"><?php echo $value->content ?></div>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-4 right-service">
                    <form action="service.php?action=search" method="POST">
                        <div class="search1 search-service1">
                            <input class="input-ser" type="text" name="title"
                                value="<?= !empty($title) ? $title : "" ?>" placeholder="Tìm kiếm">
                            <input class="icon1" type="submit" value="Tìm" id="">
                        </div>
                    </form>
                    <h1>bài viết mới nhất</h1>
                    <div class="title-news-service">
                        <?php foreach ($result_news as $key => $value) { ?>
                        <div class="title-news-service-chil">
                            <div class="news-service-chil">
                                <a href="news-chil.php?id=<?php echo $value->id ?>"><img
                                        src="<?php echo $value->image ?>" alt="image"></a>
                                <a class="desc"
                                    href="news-chil.php?id=<?php echo $value->id ?>"><?php echo $value->title ?></a>
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