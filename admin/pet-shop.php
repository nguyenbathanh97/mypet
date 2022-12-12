<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';

$sqlSl_sv_shop1 = "SELECT * FROM category_shop";
$query_sv_shop1 = $conn->prepare($sqlSl_sv_shop1);
$query_sv_shop1->execute();
$result_sv_shop1 = $query_sv_shop1->fetchAll(PDO::FETCH_OBJ);

$sqlSl_sv = "SELECT * FROM category_shop a join shop b on a.id = b.id_category";
$query_sv = $conn->prepare($sqlSl_sv);
$query_sv->execute();
$result_sv = $query_sv->fetchAll(PDO::FETCH_OBJ);
if (isset($_POST['btn-add-form']) && ($_POST['btn-add-form'])) {
    $title = $_POST['title'];
    $content = $_POST['desc'];
    $price = $_POST['price'];
    $promotion = $_POST['promotion'];
    $id_category = $_POST['id_category'];
    $status_shop = $_POST['status_shop'];
    if (isset($_FILES["image"])) {
        $imagePNG = basename($_FILES["image"]["name"]);
        $imageName = strtolower(vn2en($imagePNG));
        $target_dir = "./image/";
        $target_file = $target_dir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $imageName);
    }
    $sql = "INSERT INTO shop (title, content, price, promotion, id_category, image, status_shop) VALUES (:title, :desc, :price, :promotion, :id_category, :image, :status_shop)";
    $query = $conn->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':desc', $content, PDO::PARAM_STR);
    $query->bindParam(':price', $price, PDO::PARAM_STR);
    $query->bindParam(':promotion', $promotion, PDO::PARAM_STR);
    $query->bindParam(':id_category', $id_category, PDO::PARAM_STR);
    $query->bindParam(':image', $target_file, PDO::PARAM_STR);
    $query->bindParam(':status_shop', $status_shop, PDO::PARAM_STR);
    $query_excute = $query->execute();
    if ($query_excute) {
        $_SESSION['message'] = 'Đã thêm!';
        header('location: ./pet-shop.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Lỗi!';
        header('location: ./pet-shop.php');
        exit(0);
    }
}

if (isset($_REQUEST['delete_sv']) && ($_REQUEST['delete_sv'])) {
    $delete_sv = intval($_GET['delete_sv']);
    $sql_sv = "DELETE FROM shop WHERE id = $delete_sv";
    // var_dump($sql_sv);
    // die();
    $query_sv = $conn->prepare($sql_sv);
    $query_sv->execute();
    if ($query_sv) {
        header("Location: ./pet-shop.php");
    } else {
        echo "Lỗi!";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM shop WHERE id = $id";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    if (isset($_POST['btn-edit-form']) && ($_POST['btn-edit-form'])) {
        $title = $_POST['title'];
        $content = $_POST['descc'];
        $price = $_POST['price'];
        $promotion = $_POST['promotion'];
        $id_category = $_POST['id_category'];
        $status_shop = $_POST['status_shop'];
        if (isset($_FILES["image"])) {
            $imagePNG = basename($_FILES["image"]["name"]);
            if (empty($imagePNG)) {
                $target_file = $result->image;
            } else {
                $imageName = strtolower(vn2en($imagePNG));
                $target_dir = "./image/";
                $target_file = $target_dir . $imageName;
                move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $imageName);
            }
        }
        $sql = "UPDATE shop SET title = '$title',image = '$target_file', content = '$content', price = '$price', promotion = '$promotion', id_category = '$id_category', status_shop = '$status_shop' WHERE id = $id";
        $query = $conn->prepare($sql);
        $query_excute = $query->execute();
        if ($query_excute) {
            $_SESSION['message'] = 'Đã thêm!';
            header('location: ./pet-shop.php');
            exit(0);
        } else {
            $_SESSION['message'] = 'Lỗi!';
            header('location: ./pet-shop.php');
            exit(0);
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
    <title>Sản phẩm pet shop</title>
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
        <div class="main-infor-in">
            <div class="main-infor-chil">
                <div class="container-sevice main-infor-chil-in">
                    <div class="title-show-top-1">
                        <div class="add-infor">
                            <input class="btn-add-shop1" type="submit" name="btn-add-shop1" value="Thêm sản phẩm">
                        </div>
                        <div class="title-show-top title-show-top2"><i class="fas fa-paw"></i>
                            <h1>Quản cửa hàng pet shop</h1><i class="fas fa-paw"></i>
                        </div>
                    </div>
                    <div class="form-infor">
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
                                            Danh mục
                                        </th>
                                        <th>
                                            Hình ảnh
                                        </th>
                                        <th>
                                            Giá
                                        </th>
                                        <th>
                                            Khuyến mãi
                                        </th>
                                        <th>
                                            Mô tả
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
                                            <td style="width:200px">
                                                <?php echo $value->title ?>
                                            </td>
                                            <td>
                                                <?php echo $value->category_title ?>
                                            </td>
                                            <td>
                                                <img style="width: 125px; height: 125px ;" src=".<?php echo $value->image ?>" alt="image">
                                            </td>
                                            <td>
                                                <?php echo $value->price ?>
                                            </td>
                                            <td>
                                                <?php if ($value->promotion == 0) { ?>
                                                    <?php echo "Không" ?>
                                                <?php } else { ?>
                                                    <?php echo $value->promotion ?>
                                                <?php } ?>
                                            </td>
                                            <td class="desc-content-shop">
                                                <?php echo $value->content ?>
                                            </td>
                                            <td class="status_pet_shop">
                                                <?php if ($value->status_shop == 1) { ?>
                                                    <?php echo "Đang hiện thị" ?>
                                                <?php } else { ?>
                                                    <?php echo "Đã ẩn"; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="button-edit-delete">
                                                    <div class="btn-edit-pre">
                                                        <a class="btn-edit btn-edit-sevice" href="./pet-shop.php?id=<?php echo $value->id ?>"><i class="fas fa-edit"></i></a>
                                                    </div>
                                                    <div class="btn-delete-pre">
                                                        <a class="btn-delete" href="./pet-shop.php?delete_sv=<?php echo $value->id ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');"><i class="fas fa-trash-alt"></i></a>
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
        <div class="form-add show-pet-shop-add">
            <div class="add-sevice-last form-add-chil show-pet-shop">
                <div class="title-form-add show-top-all">
                    <h1>Thêm sản phẩm</h1>
                    <a class="close-add" href="#"><i class="fas fa-times"></i></a>
                </div>
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="change-category-shop">
                        <div class="input-add input-add-shop">
                            <p>Tiêu đề</p>
                            <input type="text" name="title">
                        </div>
                        <div class="input-add-category">
                            <p>Chọn danh mục sản phẩm</p>
                            <select name="id_category" id="">
                                <?php foreach ($result_sv_shop1 as $key => $value) { ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->category_title ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="input-add">
                        <p>Nhập nội dung</p>
                        <textarea class="desc-infor desc-infor-shop" name="desc"></textarea>
                    </div>
                    <div class="group-add-news-img-status">
                        <div class="display-image-news-all">
                            <div class="input-add">
                                <p>Chọn ảnh</p>
                                <input id="add-id-shop-image" type="file" name="image" onchange="ImageFileAsUrlAddShop()">
                            </div>
                            <div id="display-news-image">
                                <p>ảnh mới chọn</p>
                                <div id="display-shop-image-chil"></div>
                            </div>
                        </div>
                        <div class="input-add add-time-input1">
                            <p>Giá sản phẩm</p>
                            <input class="price" type="number" name="price">
                        </div>
                        <div class="input-add add-time-input1">
                            <p>Giá khuyến mãi</p>
                            <input class="price" type="number" name="promotion">
                        </div>
                        <div class="input-select-news">
                            <p>Trạng thái</p>
                            <select name="status_shop" id="status_shop" class="status_shop">
                                <option value="">--Trạng thái--</option>
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                        </div>
                    </div>
                    <div class="btn-add-in btn-add-in-shop">
                        <input type="submit" id="choose-file" name="btn-add-form" value="Thêm" class="btn-add-form btn-add-form-shop">
                    </div>
                </form>
            </div>
        </div>
        <?php if (isset($_GET['id'])) { ?>
            <div class="form-edit form-edit-sevice" style="display: block;">
                <div class="edit-sevice-chil form-edit-chil form-edit-chil-sv show-sevice">
                    <div class="title-form-edit show-top-all">
                        <h1>Cập nhật sản phẩm</h1>
                        <a class="close-edit" href="./pet-shop.php"><i class="fas fa-times"></i></a>
                    </div>
                    <form action="" method="POST" enctype='multipart/form-data'>
                        <div class="edit-top-shop">
                            <div class="input-edit input-edit-shop">
                                <p>Tiêu đề</p>
                                <input type="text" value="<?php echo $result->title ?>" name="title">
                            </div>
                            <div class="input-add-category">
                                <p>Chọn danh mục sản phẩm</p>
                                <select name="id_category" id="">
                                    <?php foreach ($result_sv_shop1 as $key => $value) { ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->category_title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="input-edit">
                            <p>Nhập nội dung</p>
                            <textarea style="height:330px" class="desc-infor" value="" name="descc" id="descc"><?php echo $result->content ?></textarea>
                        </div>
                        <div class="flex-sevice-edit-button">
                            <div class="input-edit">
                                <p>Chọn ảnh</p>
                                <input id="img-input-pet-shop" type="file" name="image" onchange="ImageFileAsUrlEditShop()">
                            </div>
                            <div id="display-edit-un-shop">
                                <p>ảnh chọn mới</p>
                                <div id="display-edit-un-shop-show"></div>
                            </div>
                            <div id="display-edit-un-sevice1">
                                <p class="status-img">ảnh ban đầu</p>
                                <img src=".<?php echo $result->image ?>" alt="image">
                            </div>
                            <div class="input-add add-time-input2">
                                <p>Giá sản phẩm</p>
                                <input class="price" value="<?php echo $result->price ?>" type="number" name="price">
                            </div>
                            <div class="input-add add-time-input2">
                                <p>Giá sản phẩm</p>
                                <input class="price" value="<?php echo $result->promotion ?>" type="number" name="promotion">
                            </div>
                            <div class="group-sevice-img">
                                <p class="status-img">Trạng thái</p>
                                <select name="status_shop" id="status_shop" class="status_shop">
                                    <option value="0" <?php if ($result->status_shop == 0) echo "selected" ?>>Ẩn</option>
                                    <option value="1" <?php if ($result->status_shop == 1) echo "selected" ?>>Hiện</option>
                                </select>
                                <p class="message-slider"></p>
                            </div>
                        </div>
                        <div class="btn-edit-in">
                            <input type="submit" id="choose-file" name="btn-edit-form" value="Cập nhật" class="btn-edit-form">
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
<script>
    CKEDITOR.replace('desc');
    CKEDITOR.replace('descc');
</script>

</html>