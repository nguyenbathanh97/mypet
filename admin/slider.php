<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';

$sqlSL = "SELECT * FROM slider";
$query_Sl = $conn->prepare($sqlSL);
$query_Sl->execute();
$result_Sl = $query_Sl->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['btn-add-form']) && ($_POST['btn-add-form'])) {
    $status_slider = $_POST['status_slider'];
    if (isset($_FILES["image"])) {
        $imagePNG = basename($_FILES["image"]["name"]);
        $imageName = strtolower(vn2en($imagePNG));
        $target_dir = "./image/";
        $target_file = $target_dir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], "./image/" . $imageName);
    }
    $sql = "INSERT INTO slider (image, status_slider) VALUES (:image, :status_slider)";
    $query = $conn->prepare($sql);
    $query->bindParam(':status_slider', $status_slider, PDO::PARAM_STR);
    $query->bindParam(':image', $target_file, PDO::PARAM_STR);
    $query_excute = $query->execute();
    if ($query_excute) {
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
    $sqlSL1 = "SELECT * FROM slider WHERE id = $id";
    $query_Sl1 = $conn->prepare($sqlSL1);
    $query_Sl1->execute();
    $result_Sl1 = $query_Sl1->fetch(PDO::FETCH_OBJ);
    if (isset($_POST['btn-edit-form']) && ($_POST['btn-edit-form'])) {
        $status_slider = $_POST['status_slider'];
        if (isset($_FILES["image"])) {
            $imagePNG = basename($_FILES["image"]["name"]);
            $imageName = strtolower(vn2en($imagePNG));
            $target_dir = "./image/";
            $target_file = $target_dir . $imageName;
            move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $imageName);
        }
        $sql = "UPDATE slider SET image = '$target_file', status_slider = '$status_slider' WHERE id = $id";
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
    <link rel="stylesheet" href="./css-admin/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./css-admin/style.css">
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
                    <div class="slider-container">
                        <div class="title-show-top-1">
                            <div class="add-slider add-slider1">
                                <input class="btn-add-slider" type="submit" name="btn-add-slider" value="Thêm slider">
                            </div>
                            <div class="title-show-top title-show-top2"><i class="fas fa-paw"></i>
                                <h1>Quản lý slider</h1><i class="fas fa-paw"></i>
                            </div>
                        </div>
                        <div class="form-slider">
                            <form action="" method="POST">
                                <table id="my-table" cellpadding="2" cellspacing="2">
                                    <thead>
                                        <tr>
                                            <th>
                                                STT
                                            </th>
                                            <th>
                                                Image
                                            </th>
                                            <th>
                                                Trạng thái
                                            </th>
                                            <th class="button-edit-delete">
                                                <i class="fas fa-cog"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result_Sl as $key => $value) { ?>
                                            <tr class="tr-table">
                                                <td>
                                                    <?php echo $key + 1 ?>
                                                </td>
                                                <td>
                                                    <img style="width: 250px; height: 125px ;" src=".<?php echo $value->image ?>" alt="image">
                                                </td>
                                                <td>
                                                    <?php if ($value->status_slider == 1) { ?>
                                                        <?php echo "Đang hiện thị" ?>
                                                    <?php } else { ?>
                                                        <?php echo "Đã ẩn"; ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="button-edit-delete">
                                                        <div class="btn-edit-pre">
                                                            <a id="aaa" class="btn-edit" href="./slider.php?id=<?php echo $value->id ?>"><i class="fas fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-delete-pre">
                                                            <a name="btn-delete" class="btn-delete" href="./slider.php?delete=<?php echo $value->id ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');"><i class="fas fa-trash-alt"></i></a>
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
        </div>
        <div class="form-add">
            <div class="container-add-slider form-add-chil show-slider">
                <div class="title-form-add show-top-all">
                    <h1>Thêm slider</h1>
                    <a class="close-add" href="#"><i class="fas fa-times"></i></a>
                </div>
                <form action="" id="add-slider" method="POST" enctype='multipart/form-data'>
                    <div class="group-all-slider">
                        <div class="group-slider">
                            <div class="input-add">
                                <p>Chọn ảnh</p>
                                <input id="add-img-slider" type="file" name='image' onchange="ImageFileAsUrlAddSlider()" multiple />
                            </div>
                            <p class="message-slider"></p>
                        </div>
                        <div id="display-slider-add"></div>
                    </div>

                    <div class="group-slider">
                        <select name="status_slider" id="status_slider" class="status_slider">
                            <option value="">--Trạng thái--</option>
                            <option value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                        </select>
                        <p class="message-slider"></p>
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
                    <form id="form-edit-slide" action="" method="POST" enctype='multipart/form-data'>
                        <div class="group-all-slider">
                            <div class="group-slider">
                                <div class="input-edit">
                                    <p>Chọn ảnh</p>
                                    <input id="edit-img-slider" type="file" name="image" onchange="ImageFileAsUrlEditSlider()">
                                </div>
                                <p class="message-slider"></p>
                            </div>
                            <div id="display-image"></div>
                            <div id="display-image-change">
                                <p class="status-img">ảnh ban đầu</p>
                                <div class="display-image-change-chil">
                                    <img src=".<?php echo $result_Sl1->image ?>" alt="image">
                                </div>
                            </div>
                        </div>
                        <div class="group-slider">
                            <p class="status-img">Trạng thái</p>
                            <select name="status_slider" id="status_slider" class="status_slider">
                                <option value="0" <?php if ($result_Sl1->status_slider == 0) echo "selected" ?>>Ẩn</option>
                                <option value="1" <?php if ($result_Sl1->status_slider == 1) echo "selected" ?>>Hiện</option>
                            </select>
                            <p class="message-slider"></p>
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
<script type="text/javascript" src="./js-admin/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js-admin/main-admin.js"></script>
<script>
    $(document).ready(function() {
        $("#my-table").DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
            },
            pageLength: 5,
            lengthMenu: [1, 2, 3, 4, 5, 10, 15, 20, 30, 50, 100],
        });
    });
</script>

</html>