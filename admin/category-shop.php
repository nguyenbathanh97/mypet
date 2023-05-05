<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';


$sqlSl_sv1 = "SELECT * FROM category_shop";
$query_sv1 = $conn->prepare($sqlSl_sv1);
$query_sv1->execute();
$result_sv1 = $query_sv1->fetch(PDO::FETCH_OBJ);

$sqlSl_sv = "SELECT * FROM category_shop";
$query_sv = $conn->prepare($sqlSl_sv);
$query_sv->execute();
$result_sv = $query_sv->fetchAll(PDO::FETCH_OBJ);
if (isset($_POST['btn-add-form']) && ($_POST['btn-add-form'])) {
    $category_title = $_POST['category_title'];
    $status_category_shop = $_POST['status_category_shop'];
    if (isset($_FILES["image"])) {
        $imagePNG = basename($_FILES["image"]["name"]);
        $imageName = strtolower(vn2en($imagePNG));
        $target_dir = "./image/";
        $target_file = $target_dir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $imageName);
    }
    $sql = "INSERT INTO category_shop (category_title, status_category_shop, slider) VALUES (:category_title, :status_category_shop, :image)";
    $query = $conn->prepare($sql);
    $query->bindParam(':category_title', $category_title, PDO::PARAM_STR);
    $query->bindParam(':status_category_shop', $status_category_shop, PDO::PARAM_STR);
    $query->bindParam(':image', $target_file, PDO::PARAM_STR);
    $query_excute = $query->execute();
    if ($query_excute) {
        header('location: ./category-shop.php');
    } else {
        header('location: ./category-shop.php');
    }
}
if (isset($_REQUEST['delete_sv']) && ($_REQUEST['delete_sv'])) {
    $delete_sv = intval($_GET['delete_sv']);
    //     var_dump($delete_sv);
    // die();
    $sql_sv = "DELETE FROM category_shop WHERE id = $delete_sv";
    $query_sv = $conn->prepare($sql_sv);
    $query_sv->execute();
    if ($query_sv) {
        header("Location: ./category-shop.php");
    } else {
        echo "Lỗi!";
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_edit = "SELECT * FROM category_shop  WHERE id = $id";
    $query_edit = $conn->prepare($sql_edit);
    $query_edit->execute();
    $result_edit = $query_edit->fetch(PDO::FETCH_OBJ);
    $id = $_GET['id'];
    if (isset($_POST['btn-edit-form']) && ($_POST['btn-edit-form'])) {
        $category_title = $_POST['category_title'];
        $status_category_shop = $_POST['status_category_shop'];
        if (isset($_FILES["image"])) {
            $imagePNG = basename($_FILES["image"]["name"]);
            if (empty($imagePNG)) {
                $target_file = $result_edit->image;
            } else {
                $imageName = strtolower(vn2en($imagePNG));
                $target_dir = "./image/";
                $target_file = $target_dir . $imageName;
                move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $imageName);
            }
        }
        $sql = "UPDATE category_shop SET category_title = '$category_title', slider = '$target_file', status_category_shop = '$status_category_shop' WHERE id = $id";
        $query = $conn->prepare($sql);
        $query->execute();
        if ($query) {
            header("Location: ./category-shop.php");
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
    <title>Danh mục</title>
    <link href='//fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="../lib/fontawesome/css/all.min.css">
    <?php
    include "../include/link-css.php";
    ?>
    <link rel="stylesheet" href="./css-admin/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./css-admin/style.css">
</head>

<body>
    <!-- menu  -->
    <?php
    include("menu.php");
    ?>
    <!-- menu  -->
    <div class="main-infor">
        <div class="main-category-in">
            <div class="main-category-chil">
                <div class="container-sevice main-category-chil-in">
                    <div class="title-show-top-1">
                        <div class="add-infor">
                            <input class="btn-add-shop-category" type="submit" name="btn-add-shop-category"
                                value="Thêm danh mục">
                        </div>
                        <div class="title-show-top title-show-top2"><i class="fas fa-paw"></i>
                            <h1>Quản danh mục cửa hàng pet shop</h1><i class="fas fa-paw"></i>
                        </div>
                    </div>
                    <div class="form-category-shop">
                        <form action="" method="POST">
                            <table id="my-table" cellpadding="2" cellspacing="2">
                                <thead>
                                    <tr>
                                        <th>
                                            STT
                                        </th>
                                        <th>
                                            Tiêu đề
                                        </th>
                                        <th>
                                            Hình ảnh
                                        </th>
                                        <th>
                                            Trạng thái
                                        </th>
                                        <th>
                                            <i class="fas fa-cog"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result_sv as $key => $value) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $key + 1 ?>
                                        </td>
                                        <td>
                                            <?php echo $value->category_title ?>
                                        </td>
                                        <td>
                                            <img style="width: 125px ; heigth: 125px"
                                                src=".<?php echo $value->slider ?>" alt="image">
                                        </td>
                                        <td>
                                            <?php if ($value->status_category_shop == 1) { ?>
                                            <?php echo "Đang hiện thị" ?>
                                            <?php } else { ?>
                                            <?php echo "Đã ẩn"; ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="button-edit-delete">
                                                <div class="btn-edit-pre">
                                                    <a class="btn-edit btn-edit-sevice"
                                                        href="./category-shop.php?id=<?php echo $value->id ?>"><i
                                                            class="fas fa-edit"></i></a>
                                                </div>
                                                <div class="btn-delete-pre">
                                                    <a class="btn-delete"
                                                        href="./category-shop.php?delete_sv=<?php echo $value->id ?>"
                                                        onclick="return confirm('Bạn chắc chắn muốn xóa?');"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-add-infor form-add-category-shop">
            <div class="container-add-infor form-add-chil show-category-shop">
                <div class="title-form-add show-top-all">
                    <h1>Thêm thông tin khách sạn mypet</h1>
                    <a class="close-add" href="#"><i class="fas fa-times"></i></a>
                </div>
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="input-add title-input">
                        <p>Tiêu đề</p>
                        <input type="text" name="category_title">
                    </div>
                    <div class="flex-slider-category">
                        <div class="image-slider-category">
                            <p class="slider-category">Thêm ảnh</p>
                            <input id="add-categoy-img-slider" type="file" name="image"
                                onchange="ImageFileAsUrlAddCategory()">
                        </div>
                        <div id="display-add-categoy-slider"></div>
                        <div class="group-category-shop">
                            <p class="status-img">Trạng thái</p>
                            <select name="status_category_shop" id="status_category_shop" class="status_category_shop">
                                <option value="">--Trạng thái--</option>
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                            <p class="message-slider"></p>
                        </div>
                    </div>
                    <div class="btn-add-in">
                        <input type="submit" id="choose-file" name="btn-add-form" value="Thêm" class="btn-add-form">
                    </div>
                </form>
            </div>
        </div>
        <?php if (isset($_GET['id'])) { ?>
        <div class="form-edit">
            <div class="infor-edit-container form-edit-chil show-category">
                <div class="title-form-edit show-top-all">
                    <h1>Cập nhật danh mục sản phẩm</h1>
                    <a class="close-edit" href="./category-shop.php"><i class="fas fa-times"></i></a>
                </div>
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="input-add title-input">
                        <p>Tiêu đề</p>
                        <input class="input-mypet" type="text" value="<?php echo $result_edit->category_title ?>"
                            name="category_title">
                    </div>
                    <div class="flex-slider-category">
                        <div class="group-img-category-shop">
                            <div class="image-slider-category">
                                <p class="slider-category">Thêm ảnh</p>
                                <input id="edit-categoy-img-slider" type="file" name="image"
                                    onchange="ImageFileAsUrlEditCategory()">
                            </div>
                            <div class="show-img-category-shop1">
                                <p>Ảnh mới chọn</p>
                                <div id="display-edit-categoy-slider1"></div>
                            </div>
                            <div class="show-img-category-shop">
                                <p>Ảnh trước</p>
                                <div id="display-edit-categoy-slider">
                                    <img src=".<?php echo $result_edit->slider ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="group-hotel">
                            <p class="status-img">Trạng thái</p>
                            <select name="status_category_shop" id="status_category_shop" class="status_category_shop">
                                <option value="0" <?php if ($result_edit->status_category_shop == 0) echo "selected" ?>>
                                    Ẩn</option>
                                <option value="1" <?php if ($result_edit->status_category_shop == 1) echo "selected" ?>>
                                    Hiện</option>
                            </select>
                            <p class="message-hotel"></p>
                        </div>
                    </div>
                    <div class="btn-edit-in">
                        <input type="submit" name="btn-edit-form" value="cập nhật" class="btn-edit-form">
                    </div>
                </form>
            </div>
        </div>
        <?php  } ?>
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
<script type="text/javascript" src="./js-admin/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js-admin/main-admin.js"></script>
<script>
$(document).ready(function() {
    $("#my-table").DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
        },
        pageLength: 10,
        lengthMenu: [1, 2, 3, 4, 5, 10, 15, 20, 30, 50, 100],
    });
});
</script>

</html>