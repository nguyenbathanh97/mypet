<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';


$sqlSl_sv = "SELECT * FROM user";
$query_sv = $conn->prepare($sqlSl_sv);
$query_sv->execute();
$result_sv = $query_sv->fetchAll(PDO::FETCH_OBJ);

if (isset($_GET['id'])) {
    $id_user = $_GET['id'];
    $sql_s = "SELECT * FROM user WHERE id = $id_user";
    $query_s = $conn->prepare($sql_s);
    $query_s->execute();
    $result_s = $query_s->fetch(PDO::FETCH_OBJ);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_POST['btn-edit-form']) && ($_POST['btn-edit-form'])) {
        $select = $_POST['select'];
        $sql = "UPDATE user SET status = '$select' WHERE id = $id";
        $query = $conn->prepare($sql);
        $query_excute = $query->execute();
        if ($query_excute) {
            header('location: ./user.php');
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
    <title>User</title>
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
                    <div class="title-s">
                        <div class="title-show-top title-show-top2"><i class="fas fa-paw"></i>
                            <h1>Quản lý user</h1><i class="fas fa-paw"></i>
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
                                            Họ tên
                                        </th>
                                        <th>
                                            Tên người dùng
                                        </th>
                                        <th>
                                            email
                                        </th>
                                        <th>
                                            Điện thoại
                                        </th>
                                        <th>
                                            Địa chỉ
                                        </th>
                                        <th>
                                            hình ảnh
                                        </th>
                                        <th>
                                            Phân quyền
                                        </th>
                                        <th class="button-edit">
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
                                            <?php echo $value->name ?>
                                        </td>
                                        <td>
                                            <?php echo $value->username ?>
                                        </td>
                                        <td>
                                            <?php echo $value->email ?>
                                        </td>
                                        <td>
                                            <?php echo $value->phone ?>
                                        </td>
                                        <td class="address-user">
                                            <?php echo $value->address ?>
                                        </td>
                                        <td>
                                            <img style="width: 65px; height: 65px ;" src=".<?php echo $value->image ?>"
                                                alt="image">
                                        </td>
                                        <?php if ($value->status == 0) { ?>
                                        <td>
                                            <?php echo "Người dùng" ?>
                                        </td>
                                        <?php } else { ?>
                                        <td>
                                            <?php echo "Quản lý" ?>
                                        </td>
                                        <?php } ?>
                                        <td>
                                            <div class="button-edit">
                                                <div class=" btn-edit-pre">
                                                    <a class="btn-edit btn-edit-sevice"
                                                        href="./user.php?id=<?php echo $value->id ?>"><i
                                                            class="fas fa-edit"></i></a>
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
        <?php if (isset($_GET['id'])) { ?>
        <div class="form-edit form-edit-sevice">
            <div class="edit-sevice-chil form-edit-chil form-edit-chil-sv show-news">
                <div class="title-form-edit show-top-all">
                    <h1>Phân quyền</h1>
                    <a class="close-edit" href="./user.php"><i class="fas fa-times"></i></a>
                </div>
                <form class="form-user" action="" method="POST" enctype='multipart/form-data'>
                    <div class="input-edit input-edit-af">
                        <p>Phân quyền quản lý</p>
                        <select name="select" id="select-user">
                            <option value="0" <?php if ($result_s->status == 0) echo "selected" ?>>Người dùng</option>
                            <option value="1" <?php if ($result_s->status == 1) echo "selected" ?>>Quản lý</option>
                        </select>
                    </div>
                    <div class="btn-edit-in">
                        <input type="submit" name="btn-edit-form" value="Cập nhật" class="btn-edit-form">
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