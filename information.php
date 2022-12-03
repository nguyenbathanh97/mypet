<?php
include './include/config.php';
$sql ="SELECT * FROM about";
$query= $conn -> prepare($sql);
$query-> execute();
$result = $query->fetch(PDO::FETCH_OBJ);
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
    <div class="main-information">
        <div class="container">
            <div class="title"><?php echo $result->title ?></div>
            <p class="desc-infor"><?php echo $result->content ?></p>
            <div class="spach"></div>
        </div>
    </div>
    <!-- footer  -->
    <?php
    include "./include/footer.php";
    ?>
    <!-- /footer  -->
</body>

</html>