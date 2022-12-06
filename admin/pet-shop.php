<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';


$sqlSl_sv = "SELECT * FROM sevice";
$query_sv = $conn->prepare($sqlSl_sv);
$query_sv->execute();
$result_sv = $query_sv->fetchAll(PDO::FETCH_OBJ);
if (isset($_POST['btn-add-form']) && ($_POST['btn-add-form'])) {
    $title = $_POST['title'];
    $content = $_POST['desc'];
    if (isset($_FILES["image"])) {
        $imagePNG = basename($_FILES["image"]["name"]);
        $imageName = strtolower(vn2en($imagePNG));
        $target_dir = "./image/";
        $target_file = $target_dir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $imageName);
    }
    $sql = "INSERT INTO sevice (title, content, image) VALUES (:title, :desc, :image)";
    $query = $conn->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':desc', $content, PDO::PARAM_STR);
    $query->bindParam(':image', $target_file, PDO::PARAM_STR);
    $query_excute = $query->execute();
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
$sqlSl_sv1 = "SELECT * FROM sevice";
$query_sv1 = $conn->prepare($sqlSl_sv1);
$query_sv1->execute();
$result_sv1 = $query_sv1->fetch(PDO::FETCH_OBJ);
if (isset($_REQUEST['delete_sv']) && ($_REQUEST['delete_sv'])) {
    $delete_sv = intval($_GET['delete_sv']);
    //     var_dump($delete_sv);
    // die();
    $sql_sv = "DELETE FROM sevice WHERE id = $delete_sv";
    $query_sv = $conn->prepare($sql_sv);
    $query_sv->execute();
    if ($query_sv) {
        header("Location: ./sevice.php");
    } else {
        echo "Lỗi!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dịch vụ</title>
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
    <div class="main-infor">
        <div class="main-infor-in">
            <div class="main-infor-chil">
                <div class="container-sevice main-infor-chil-in">
                    <h1 class="title-infor">
                        Dịch vụ
                    </h1>
                    <div class="line-h1">
                        <div class="line-in"></div>
                        <i class="fas fa-star"></i>
                        <i class="center fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <div class="line-in"></div>
                    </div>
                    <div class="add-infor">
                        <input class="btn-add-sevice" type="submit" name="btn-add-sevice" value="Thêm dịch vụ">
                    </div>
                    <div class="form-infor">
                        <form action="" method="POST">
                            <div class="table">
                                <div class="row blue">
                                    <div class="cell cell-title">
                                        STT
                                    </div>
                                    <div class="cell cell-title">
                                        Tiêu đề
                                    </div>
                                    <div class="cell cell-title">
                                        Hình ảnh
                                    </div>
                                    <div class="cell cell-title">
                                        mô tả
                                    </div>
                                    <div class="cell cell-title">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                </div>
                                <?php foreach ($result_sv as $key => $value) { ?>
                                    <div class="row">
                                        <div class="cell">
                                            <?php echo $key + 1 ?>
                                        </div>
                                        <div class="cell">
                                            <?php echo $value->title ?>
                                        </div>
                                        <div class="cell cell-img-sv">
                                            <img src=".<?php echo $value->image ?>" alt="image">
                                        </div>
                                        <div class="cell">
                                            <?php echo $value->content ?>
                                        </div>
                                        <div class="cell cell-change">
                                            <div class="btn-edit-pre">
                                                <a class="btn-edit btn-edit-sevice" href="./sevice-edit.php?id=<?php echo $value->id ?>">Sửa</a>
                                            </div>
                                            <div class="btn-delete-pre">
                                                <a class="btn-delete" href="./sevice.php?delete_sv=<?php echo $value->id ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-add" id="form-add-sevice">
            <div class="add-sevice-last form-add-chil">
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="title-form-add">
                        <h1>Thêm Dịch vụ</h1>
                        <a class="close-add" href="#"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="input-add">
                        <p>Tiêu đề</p>
                        <input type="text" name="title">
                    </div>
                    <div class="input-add">
                        <p>Nhập nội dung</p>
                        <textarea class="desc-infor" name="desc" id="desc"></textarea>
                    </div>
                    <div class="input-add">
                        <p>Chọn ảnh</p>
                        <input type="file" name="image">
                    </div>
                    <div class="btn-add-in">
                        <input type="submit" id="choose-file" name="btn-add-form" value="Thêm" class="btn-add-form">
                    </div>
                </form>
            </div>
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
<script type="text/javascript" src="./js-admin/main-admin.js"></script>

</html>