<?php
include '../include/slug.php';
include '../include/config.php';
$id = $_GET['id'];
$sql = "SELECT * FROM sevice WHERE id = $id";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
if (isset($_POST['btn-edit-form']) && ($_POST['btn-edit-form'])) {
    $title = $_POST['title'];
    $content = $_POST['desc'];
    if (isset($_FILES["image"])) {
        $imagePNG = basename($_FILES["image"]["name"]);
        $imageName = strtolower(vn2en($imagePNG));
        $target_dir = "./image/";
        $target_file = $target_dir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $imageName);
    }
    $sql ="UPDATE sevice SET title = '$title',image = '$target_file', content = '$content' WHERE id = $id";
    $query = $conn->prepare($sql);
    $query_excute=$query->execute();
    if ($query_excute) {
        $_SESSION['message'] = 'Đã thêm!';
        header('location: ./sevice.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Lỗi!';
        header('location: ./sevice.php');
        exit(0);
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
    <div class="form-edit form-edit-sevice">
        <div class="edit-sevice-chil form-edit-chil form-edit-chil-sv">
            <form action="" method="POST" enctype='multipart/form-data'>
                <div class="title-form-edit">
                    <h1>Cập nhật Dịch vụ</h1>
                    <a class="close-edit" href="./sevice.php"><i class="fas fa-times"></i></a>
                </div>
                <div class="input-edit input-edit-af">
                    <p>Tiêu đề</p>
                    <input type="text" value="<?php echo $result->title ?>" name="title">
                </div>
                <div class="input-edit">
                    <p>Nhập nội dung</p>
                    <textarea style="height:330px" class="desc-infor" value="" name="desc" id="desc"><?php echo $result->content ?></textarea>
                </div>
                <div class="input-edit">
                    <p>Chọn ảnh</p>
                    <input type="file" name="image">
                </div>
                <div class="btn-edit-in">
                    <input type="submit" id="choose-file" name="btn-edit-form" value="Cập nhật" class="btn-edit-form">
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