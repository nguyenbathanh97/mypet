<?php
include '../include/slug.php';
include '../include/config.php';

$sql ="SELECT * FROM about";
$query= $conn -> prepare($sql);
$query-> execute();
$result = $query->fetch(PDO::FETCH_OBJ);
$id = $_GET['id'];
if (isset($_POST['btn-edit-form']) && ($_POST['btn-edit-form'])) {
    $title = $_POST['title'];
    $content = $_POST['desc'];
    $sql ="UPDATE about SET title = '$title', content = '$content' WHERE id = $id";
    $query = $conn->prepare($sql);
    $query->execute();
    if ($query) {
        header("Location: ./infor.php");
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
        <div class="infor-edit-container form-edit-chil">
            <form action="" method="POST" enctype='multipart/form-data'>
                <div class="title-form-edit">
                    <h1>Cập nhật thông tin</h1>
                    <a class="close-edit" href="./infor.php"><i class="fas fa-times"></i></a>
                </div>
                <div class="input-add">
                    <p>Tiêu đề</p>
                    <input class="input-mypet" type="text" value="<?php echo $result->title ?>" name="title">
                </div>
                <div class="input-add">
                    <p>Nhập nội dung</p>
                    <textarea class="desc-infor" value="" name="desc" id="desc"><?php echo $result->content ?></textarea>
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
<script src="../lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="main-admin.js"></script>

</html>