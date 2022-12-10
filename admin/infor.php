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
    $status_about = $_POST['status_about'];
    $sql = "INSERT INTO about (title, content, status_about) VALUES (:title, :desc, :status_about)";
    $query = $conn->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':desc', $content, PDO::PARAM_STR);
    $query->bindParam(':status_about', $status_about, PDO::PARAM_STR);
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
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_edit = "SELECT * FROM about  WHERE id = $id";
    $query_edit = $conn->prepare($sql_edit);
    $query_edit->execute();
    $result_edit = $query_edit->fetch(PDO::FETCH_OBJ);
    $id = $_GET['id'];
    if (isset($_POST['btn-edit-form']) && ($_POST['btn-edit-form'])) {
        $title = $_POST['title'];
        $content = $_POST['descc'];
        $status_about = $_POST['status_about'];
        $sql = "UPDATE about SET title = '$title', content = '$content', status_about = '$status_about' WHERE id = $id";
        $query = $conn->prepare($sql);
        $query->execute();
        if ($query) {
            header("Location: ./infor.php");
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
    <title>Thông tin</title>
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
                <div class="infor-container main-infor-chil-in">
                    <div class="title-show-top-1">
                        <div class="add-infor add-slider1">
                            <input class="btn-add-infor" type="submit" name="btn-add-infor" value="Thêm giới thiêu">
                        </div>
                        <div class="title-show-top title-show-top2"><i class="fas fa-paw"></i>
                            <h1>Quản lý Thông tin Mypet</h1><i class="fas fa-paw"></i>
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
                                            Trạng thái
                                        </th>
                                        <th class="button-edit-delete">
                                            <i class="fas fa-cog"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $key => $value) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $key + 1 ?>
                                            </td>
                                            <td>
                                                <?php echo $value->title ?>
                                            </td>
                                            <td>
                                                    <?php if ($value->status_about == 1) { ?>
                                                        <?php echo "Đang hiện thị"?>
                                                    <?php } else { ?>
                                                        <?php echo "Đã ẩn"; ?>
                                                    <?php } ?>
                                                </td>
                                            <td>
                                                <div class="button-edit-delete">
                                                    <div class="btn-edit-pre">
                                                        <a class="btn-edit" href="./infor.php?id=<?php echo $value->id ?>"><i class="fas fa-edit"></i></a>
                                                    </div>
                                                    <div class="btn-delete-pre">
                                                        <a class="btn-delete" href="./infor.php?delete=<?php echo $value->id ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');"><i class="fas fa-trash-alt"></i></a>
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
        <div class="form-add-infor">
            <div class="container-add-infor form-add-chil show-infor">
                <div class="title-form-add show-top-all">
                    <h1>Thêm thông tin giới thiệu</h1>
                    <a class="close-add" href="#"><i class="fas fa-times"></i></a>
                </div>
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="input-add">
                        <p>Tiêu đề</p>
                        <input class="title-input-infor" type="text" name="title">
                    </div>
                    <div class="input-add">
                        <p>Nhập nội dung</p>
                        <textarea class="desc-infor" name="desc"></textarea>
                    </div>
                    <select name="status_about" id="status_about" class="status_about">
                        <option value="">--Trạng thái--</option>
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>
                    </select>
                    <div class="btn-add-in">
                        <input type="submit" id="choose-file" name="btn-add-form" value="Thêm" class="btn-add-form">
                    </div>
                </form>
            </div>
        </div>
        <?php if (isset($_GET['id'])) { ?>
            <div class="form-edit">
                <div class="infor-edit-container form-edit-chil show-infor">
                    <div class="title-form-edit show-top-all">
                        <h1>Cập nhật thông tin</h1>
                        <a class="close-edit" href="./infor.php"><i class="fas fa-times"></i></a>
                    </div>
                    <form action="" method="POST" enctype='multipart/form-data'>
                        <div class="input-add">
                            <p>Tiêu đề</p>
                            <input class="input-mypet" type="text" value="<?php echo $result_edit->title ?>" name="title">
                        </div>
                        <div class="input-add">
                            <p>Nhập nội dung</p>
                            <textarea class="desc-infor" value="" name="descc" id="descc"><?php echo $result_edit->content ?></textarea>
                        </div>
                        <div class="group-infor">
                            <p class="status-img">Trạng thái</p>
                            <select name="status_about" id="status_about" class="status_about">
                                <option value="0" <?php if ($result_edit->status_about == 0) echo "selected" ?>>Ẩn</option>
                                <option value="1" <?php if ($result_edit->status_about == 1) echo "selected" ?>>Hiện</option>
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