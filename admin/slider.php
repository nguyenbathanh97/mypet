<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';

$sqlSl = "SELECT * FROM slider";
$result = $conn->query($sqlSl);
if (isset($_POST['btn-add-form']) && ($_POST['btn-add-form'])) {
    if (isset($_FILES["image"])) {
        $imagePNG = basename($_FILES["image"]["name"]);
        $imageName = strtolower(vn2en($imagePNG));
        $target_dir = "./image/";
        $target_file = $target_dir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], "./image/" . $imageName);
    }
    $sql = "INSERT INTO slider (image) VALUES ('$target_file')";
    $query = $conn->query($sql);
    if ($query) {
        header("Location: ./slider.php");
    } else {
        echo "<label>Lỗi</label>";
    }
}
if (isset($_REQUEST['delete']) && ($_REQUEST['delete'])) {
    $delete = intval($_GET['delete']);
    $sql = "DELETE FROM slider WHERE id = $delete";
    $query = $conn->query($sql);
    if ($query) {
        header("Location: ./slider.php");
    } else {
        echo "Lỗi!";
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_POST['btn-edit-form']) && ($_POST['btn-edit-form'])) {
        if (isset($_FILES["image"])) {
            $imagePNG = basename($_FILES["image"]["name"]);
            $imageName = strtolower(vn2en($imagePNG));
            $target_dir = "./image/";
            $target_file = $target_dir . $imageName;
            move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $imageName);
        }
        $sql = "UPDATE slider SET image = '$target_file' WHERE id = $id";
        $query = $conn->prepare($sql);
        $query->execute();
        if ($query) {
            header("Location: ./slider.php");
        } else {
            echo "lỗi!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>slider</title>
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
    <div class="main-slider">
        <div class="main-slider-in">
            <div class="main-slider-chil">
                <div class=" main-slider-chil-in">
                    <h1 class="title-slider">
                        Quản lý slider
                    </h1>
                    <div class="line-h1">
                        <div class="line-in"></div>
                        <i class="fas fa-star"></i>
                        <i class="center fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <div class="line-in"></div>
                    </div>
                    <div class="slider-container">
                        <div class="add-slider">
                            <input class="btn-add-slider" type="submit" name="btn-add-slider" value="Thêm slider">
                        </div>
                        <div class="form-slider">
                            <form action="" method="POST">
                                <div class="table">
                                    <div class="row blue">
                                        <div class="cell cell-title">
                                            STT
                                        </div>
                                        <div class="cell cell-title">
                                            Image
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
                                                <img src=".<?php echo $value['image'] ?>" alt="image">
                                            </div>
                                            <div class="cell cell-change">
                                                <div class="btn-edit-pre">
                                                    <a id="aaa" class="btn-edit" href="./slider.php?id=<?php echo $value['id'] ?>">Sửa</a>
                                                </div>
                                                <div class="btn-delete-pre">
                                                    <a name="btn-delete" class="btn-delete" href="./slider.php?delete=<?php echo $value['id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a>
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
        </div>
        <div class="form-add">
            <div class="container-add-slider form-add-chil show-slider">
                <div class="title-form-add show-top-all">
                    <h1>Thêm slider</h1>
                    <a class="close-add" href="#"><i class="fas fa-times"></i></a>
                </div>
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="input-add">
                        <p>Chọn ảnh</p>
                        <input type="file" name='image' multiple />
                    </div>
                    <div class="btn-add-in">
                        <input type="submit" id="choose-file" name="btn-add-form" value="Thêm" class="btn-add-form">
                    </div>
                </form>
            </div>
        </div>
        <?php if (isset($_GET['id'])) { ?>
            <div class="form-edit">
                <div class="slider-edit-container form-edit-chil show-slider">
                    <div class="title-form-edit show-top-all">
                        <h1>Cập nhật slider</h1>
                        <a class="close-edit" href="./slider.php"><i class="fas fa-times"></i></a>
                    </div>
                    <form action="" method="POST" enctype='multipart/form-data'>
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
        <?php } ?>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="./js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="./js-admin/main-admin.js"></script>

</html>