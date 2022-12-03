<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';

$sqlSl = "SELECT * FROM about";
$query = $conn->prepare($sqlSl);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
if (isset($_POST['btn-add-form']) && ($_POST['btn-add-form'])) {
    $title = $_POST['title'];
    $content = $_POST['desc'];
    $sql = "INSERT INTO about (title, content) VALUES (:title, :desc)";
    $query = $conn->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':desc', $content, PDO::PARAM_STR);
    $query_excute = $query->execute();
    if ($query_excute) {
        $_SESSION['message'] = 'Đã thêm!';
        header('location: ./infor.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Lỗi!';
        header('location: ./infor.php');
        exit(0);
    }
}
if (isset($_REQUEST['delete']) && ($_REQUEST['delete'])) {
    $delete = intval($_GET['delete']);
    $sql = "DELETE FROM about WHERE id = $delete";
    $query = $conn->prepare($sql);
    $query->execute();
    if ($query) {
        header("Location: ./infor.php");
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
    <title>Thông tin</title>
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
                <div class="infor-container main-infor-chil-in">
                    <h1 class="title-infor">
                        Giới thiệu
                    </h1>
                    <div class="line-h1">
                        <div class="line-in"></div>
                        <i class="fas fa-star"></i>
                        <i class="center fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <div class="line-in"></div>
                    </div>
                    <div class="add-infor">
                        <input class="btn-add-infor" type="submit" name="btn-add-infor" value="Thêm giới thiêu">
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
                                        Mô tả
                                    </div>
                                    <div class="cell cell-title">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                </div>
                                <?php foreach ($result as $key => $value) { ?>
                                    <div class="row">
                                        <div class="cell">
                                            <?php echo $key + 1 ?>
                                        </div>
                                        <div class="cell">
                                            <?php echo $value->title ?>
                                        </div>
                                        <div class="cell">
                                            <?php echo $value->content ?>
                                        </div>
                                        <div class="cell cell-change">
                                            <div class="btn-edit-pre">
                                                <a class="btn-edit" href="./infor-edit.php?id=<?php echo $value->id ?>">Sửa</a>
                                            </div>
                                            <div class="btn-delete-pre">
                                                <a class="btn-delete" href="./infor.php?delete=<?php echo $value->id ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a>
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
        <div class="form-add-infor">
            <div class="container-add-infor form-add-chil">
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="title-form-add">
                        <h1>Thêm thông tin giới thiệu</h1>
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
<script type="text/javascript" src="main-admin.js"></script>
</html>