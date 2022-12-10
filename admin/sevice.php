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
    $status_sevice = $_POST['status_sevice'];
    if (isset($_FILES["image"])) {
        $imagePNG = basename($_FILES["image"]["name"]);
        $imageName = strtolower(vn2en($imagePNG));
        $target_dir = "./image/";
        $target_file = $target_dir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $imageName);
    }
    $sql = "INSERT INTO sevice (title, content, image, status_sevice) VALUES (:title, :desc, :image, :status_sevice)";
    $query = $conn->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':desc', $content, PDO::PARAM_STR);
    $query->bindParam(':image', $target_file, PDO::PARAM_STR);
    $query->bindParam(':status_sevice', $status_sevice, PDO::PARAM_STR);
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM sevice WHERE id = $id";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    if (isset($_POST['btn-edit-form']) && ($_POST['btn-edit-form'])) {
        $title = $_POST['title'];
        $content = $_POST['descc'];
        $status_sevice = $_POST['status_sevice'];
        if (isset($_FILES["image"])) {
            $imagePNG = basename($_FILES["image"]["name"]);
            if (empty( $imagePNG)) {
                $target_file = $result->image;
            } else {
                $imageName = strtolower(vn2en($imagePNG));
                $target_dir = "./image/";
                $target_file = $target_dir . $imageName;
                move_uploaded_file($_FILES["image"]["tmp_name"], "../image/" . $imageName);
            }
        }
        $sql = "UPDATE sevice SET title = '$title',image = '$target_file', status_sevice = '$status_sevice', content = '$content' WHERE id = $id";
        $query = $conn->prepare($sql);
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
                        <div class="add-infor add-slider1">
                            <input class="btn-add-sevice" type="submit" name="btn-add-sevice" value="Thêm dịch vụ">
                        </div>
                        <div class="title-show-top title-show-top2"><i class="fas fa-paw"></i>
                            <h1>Quản lý dịch vụ</h1><i class="fas fa-paw"></i>
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
                                            Hình ảnh
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
                                    <?php foreach ($result_sv as $key => $value) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $key + 1 ?>
                                            </td>
                                            <td>
                                                <?php echo $value->title ?>
                                            </td>
                                            <td>
                                                <img style="width: 125px; height: 125px ;" src=".<?php echo $value->image ?>" alt="image">
                                            </td>
                                            <td>
                                                <?php if ($value->status_sevice == 1) { ?>
                                                    <?php echo "Đang hiện thị" ?>
                                                <?php } else { ?>
                                                    <?php echo "Đã ẩn"; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="button-edit-delete">
                                                    <div class="btn-edit-pre">
                                                        <a class="btn-edit btn-edit-sevice" href="./sevice.php?id=<?php echo $value->id ?>"><i class="fas fa-edit"></i></a>
                                                    </div>
                                                    <div class="btn-delete-pre">
                                                        <a class="btn-delete" href="./sevice.php?delete_sv=<?php echo $value->id ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');"><i class="fas fa-trash-alt"></i></a>
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
        <div class="form-add" id="form-add-sevice">
            <div class="add-sevice-last form-add-chil show-sevice">
                <div class="title-form-add show-top-all">
                    <h1>Thêm Dịch vụ</h1>
                    <a class="close-add" href="#"><i class="fas fa-times"></i></a>
                </div>
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="input-add">
                        <p>Tiêu đề</p>
                        <input type="text" name="title">
                    </div>
                    <div class="input-add">
                        <p>Nhập nội dung</p>
                        <textarea class="desc-infor" name="desc"></textarea>
                    </div>
                    <div class="group-add-sevice-img-status">
                        <div class="display-image-sevice-all">
                            <div class="input-add">
                                <p>Chọn ảnh</p>
                                <input id="add-id-image" type="file" name="image" onchange="ImageFileAsUrlAddSevice()">
                            </div>
                            <div id="display-seviec-image"></div>
                        </div>
                        <select name="status_sevice" id="status_sevice" class="status_sevice">
                            <option value="">--Trạng thái--</option>
                            <option value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                        </select>
                    </div>
                    <div class="btn-add-in">
                        <input type="submit" id="choose-file" name="btn-add-form" value="Thêm" class="btn-add-form">
                    </div>
                </form>
            </div>
        </div>
        <?php if (isset($_GET['id'])) { ?>
            <div class="form-edit form-edit-sevice" style="display: block;">
                <div class="edit-sevice-chil form-edit-chil form-edit-chil-sv show-sevice">
                    <div class="title-form-edit show-top-all">
                        <h1>Cập nhật Dịch vụ</h1>
                        <a class="close-edit" href="./sevice.php"><i class="fas fa-times"></i></a>
                    </div>
                    <form action="" method="POST" enctype='multipart/form-data'>
                        <div class="input-edit input-edit-af">
                            <p>Tiêu đề</p>
                            <input type="text" value="<?php echo $result->title ?>" name="title">
                        </div>
                        <div class="input-edit">
                            <p>Nhập nội dung</p>
                            <textarea style="height:330px" class="desc-infor" value="" name="descc" id="descc"><?php echo $result->content ?></textarea>
                        </div>
                        <div class="flex-sevice-edit-button">
                            <div class="input-edit">
                                <p>Chọn ảnh</p>
                                <input id="img-input-sevice2" type="file" name="image" onchange="ImageFileAsUrlEditSevice()">
                            </div>
                            <div id="display-edit-un-sevice">
                                <p>ảnh chọn mới</p>
                                <div id="display-edit-un-sevice-show"></div>
                            </div>
                            <div id="display-edit-un-sevice1">
                                <p class="status-img">ảnh ban đầu</p>
                                <img src=".<?php echo $result->image ?>" alt="image">
                            </div>
                            <div class="group-sevice-img">
                                <p class="status-img">Trạng thái</p>
                                <select name="status_slider" id="status_slider" class="status_slider">
                                    <option value="0" <?php if ($result->status_sevice == 0) echo "selected" ?>>Ẩn</option>
                                    <option value="1" <?php if ($result->status_sevice == 1) echo "selected" ?>>Hiện</option>
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