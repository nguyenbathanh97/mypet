<?php
include '../include/slug.php';
include '../include/config.php';

$id = $_GET['id'];
if (isset($_POST['btn-edit-form']) && ($_POST['btn-edit-form'])) {
    if (isset($_FILES["image"])) {
        $imagePNG = basename($_FILES["image"]["name"]);
        $imageName = strtolower(vn2en($imagePNG));
        $target_dir = "../image/";
        $target_file = $target_dir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $imageName);
    }
    $sql ="UPDATE slider SET image = '$target_file' WHERE id = $id";
    $query = $conn->prepare($sql);
    $query->execute();
    if ($query) {
        header("Location: ./slider.php");
    } else {
        echo "lỗi!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='//fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="../lib/fontawesome/css/all.min.css">
    <?php
    include "../include/link-css.php";
    ?>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- menu  -->
    <?php
    include("menu.php");
    ?>
    <!-- menu  -->
    <div class="form-edit">
        <div class="slider-edit-container form-edit-chil">
            <form action="" method="POST" enctype='multipart/form-data'>
                <div class="title-form-edit">
                    <h1>Cập nhật slider</h1>
                    <a class="close-edit" href="./slider.php"><i class="fas fa-times"></i></a>
                </div>
                <div class="input-edit">
                    <p>Chọn ảnh</p>
                    <input type="file" name="image">
                </div>
                <div class="btn-edit-in">
                    <input type="submit" name="btn-edit-form" value="cập nhật" class="btn-edit-form">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="./js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="main-admin.js"></script>

</html>