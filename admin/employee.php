<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';

$sqlSl = "SELECT * FROM sevice WHERE status_sevice = 1";
$query = $conn->prepare($sqlSl);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);

$sqlSl1 = "SELECT * FROM sevice a join employee b on a.id = b.id_sevice WHERE  a.status_sevice = 1";
$query1 = $conn->prepare($sqlSl1);
$query1->execute();
$result1 = $query1->fetchAll(PDO::FETCH_OBJ);
if (isset($_POST['btn-add-form']) && ($_POST['btn-add-form'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $id_sevice = $_POST['id_sevice'];
    $sql = "INSERT INTO employee (name, phone, address, id_sevice) VALUES (:name, :phone, :address, :id_sevice)";
    $query = $conn->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':id_sevice', $id_sevice, PDO::PARAM_STR);
    $query_excute = $query->execute();
    if ($query_excute) {
        $_SESSION['message'] = 'Đã thêm!';
        header('location: ./employee.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Lỗi!';
        header('location: ./employee.php');
        exit(0);
    }
}
if (isset($_REQUEST['delete']) && ($_REQUEST['delete'])) {
    $delete = intval($_GET['delete']);
    $sql = "DELETE FROM employee WHERE id_employee = $delete";
    $query = $conn->prepare($sql);
    $query->execute();
    if ($query) {
        header("Location: ./employee.php");
    } else {
        echo "Lỗi!";
    }
}
if (isset($_GET['id_employee'])) {
    $id = $_GET['id_employee'];
    // var_dump($id);
    // die();
    $sql_edit = "SELECT * FROM sevice a join employee b on a.id = b.id_sevice  WHERE b.id_employee = $id";
    $query_edit = $conn->prepare($sql_edit);
    $query_edit->execute();
    $result_edit = $query_edit->fetch(PDO::FETCH_OBJ);
    $id = $_GET['id_employee'];
    if (isset($_POST['btn-edit-form']) && ($_POST['btn-edit-form'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $id_sevice = $_POST['id_sevice'];
        $sql = "UPDATE employee SET name = '$name', phone = '$phone', address = '$address', id_sevice = '$id_sevice' WHERE id_employee = $id";
        $query = $conn->prepare($sql);
        $query->execute();
        if ($query) {
            header("Location: ./employee.php");
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
    <title>Nhân viên</title>
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
                            <input class="btn-add-infor" type="submit" name="btn-add-infor" value="Thêm nhân viên">
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
                                            Họ tên
                                        </th>
                                        <th>
                                            Địa chỉ
                                        </th>
                                        <th>
                                            Điện thoại
                                        </th>
                                        <th>
                                            chuyên môn
                                        </th>
                                        <th class="button-edit-delete">
                                            <i class="fas fa-cog"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result1 as $key => $value) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $key + 1 ?>
                                        </td>
                                        <td>
                                            <?php echo $value->name ?>
                                        </td>
                                        <td>
                                            <?php echo $value->address ?>
                                        </td>
                                        <td>
                                            <?php echo $value->phone ?>
                                        </td>
                                        <td>
                                            <?php echo $value->title ?>
                                        </td>
                                        <td>
                                            <div class="button-edit-delete">
                                                <div class="btn-edit-pre">
                                                    <a class="btn-edit"
                                                        href="./employee.php?id_employee=<?php echo $value->id_employee ?>"><i
                                                            class="fas fa-edit"></i></a>
                                                </div>
                                                <div class="btn-delete-pre">
                                                    <a class="btn-delete"
                                                        href="./employee.php?delete=<?php echo $value->id_employee ?>"
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
        <div class="form-add-infor">
            <div class="container-add-infor form-add-chil show-infor">
                <div class="title-form-add show-top-all">
                    <h1>Thêm thông tin nhân viên</h1>
                    <a class="close-add" href="#"><i class="fas fa-times"></i></a>
                </div>
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="input-add-all">
                        <div class="input-add">
                            <p>Họ tên</p>
                            <input class="title-input-infor" type="text" name="name">
                        </div>
                        <div class="input-add">
                            <p>Điện thoại</p>
                            <input class="title-input-infor" type="phone" name="phone">
                        </div>
                    </div>
                    <div class="input-add">
                        <p>Địa chỉ</p>
                        <input class="title-input-infor" type="text" name="address">
                    </div>
                    <div class="input-add">
                        <p>Chuyên môn</p>
                        <select name="id_sevice" id="">
                            <?php foreach ($result as $key => $value) { ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->title ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="btn-add-in">
                        <input type="submit" id="choose-file" name="btn-add-form" value="Thêm" class="btn-add-form">
                    </div>
                </form>
            </div>
        </div>
        <?php if (isset($_GET['id_employee'])) { ?>
        <div class="form-edit">
            <div class="infor-edit-container form-edit-chil show-infor">
                <div class="title-form-edit show-top-all">
                    <h1>Cập nhật thông tin nhân viên</h1>
                    <a class="close-edit" href="./employee.php"><i class="fas fa-times"></i></a>
                </div>
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="input-add-all">
                        <div class="input-add">
                            <p>Họ tên</p>
                            <input class="input-mypet" type="text" value="<?php echo $result_edit->name ?>" name="name">
                        </div>
                        <div class="input-add">
                            <p>Điện thoại</p>
                            <input class="input-mypet" type="phone" value="<?php echo $result_edit->phone ?>"
                                name="phone">
                        </div>
                    </div>
                    <div class="input-add">
                        <p>Địa chỉ</p>
                        <input class="input-mypet" type="text" value="<?php echo $result_edit->address ?>"
                            name="address">
                    </div>
                    <div class="input-add">
                        <p>Chuyên môn</p>
                        <select name="id_sevice" id="">
                            <?php foreach ($result as $key => $value) { ?>
                            <option value="<?php echo $value->id ?>"
                                <?php if ($value->id == $result_edit->id_sevice) echo "selected"  ?>>
                                <?php echo $value->title ?></option>
                            <?php } ?>
                        </select>
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

</html>