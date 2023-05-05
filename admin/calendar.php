<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';

$sqlSl1 = "SELECT * FROM employee";
$query1 = $conn->prepare($sqlSl1);
$query1->execute();
$result1 = $query1->fetchAll(PDO::FETCH_OBJ);

$sqlSl2 = "SELECT * FROM employee a join sevice b on a.id_sevice = b.id";
$query2 = $conn->prepare($sqlSl2);
$query2->execute();
$result2 = $query2->fetchAll(PDO::FETCH_OBJ);

$sqlSl = "SELECT * FROM calendar a join employee b on a.id_employee_t = b.id_employee join sevice c on c.id = b.id_sevice";
$query = $conn->prepare($sqlSl);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['btn-add-form']) && ($_POST['btn-add-form'])) {
    $day = $_POST['day'];
    $shifts = $_POST['shifts'];
    $id_employee_t = $_POST['id_employee_t'];
    $sql = "INSERT INTO calendar (day, shifts, id_employee_t) VALUES (:day, :shifts, :id_employee_t)";
    $query = $conn->prepare($sql);
    $query->bindParam(':day', $day, PDO::PARAM_STR);
    $query->bindParam(':shifts', $shifts, PDO::PARAM_STR);
    $query->bindParam(':id_employee_t', $id_employee_t, PDO::PARAM_STR);
    $query_excute = $query->execute();
    if ($query_excute) {
        $_SESSION['message'] = 'Đã thêm!';
        header('location: ./calendar.php');
        exit(0);
    } else {
        $_SESSION['message'] = 'Lỗi!';
        header('location: ./calendar.php');
        exit(0);
    }
}
if (isset($_REQUEST['delete']) && ($_REQUEST['delete'])) {
    $delete = intval($_GET['delete']);
    $sql = "DELETE FROM calendar WHERE id_cal = $delete";
    $query = $conn->prepare($sql);
    $query->execute();
    if ($query) {
        header("Location: ./calendar.php");
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
    <title>Lịch biểu</title>
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
                            <input class="btn-add-infor" type="submit" name="btn-add-infor" value="Thêm thời gian">
                        </div>
                        <div class="title-show-top title-show-top2"><i class="fas fa-paw"></i>
                            <h1>Quản lý lịch làm việc</h1><i class="fas fa-paw"></i>
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
                                            Thứ
                                        </th>
                                        <th>
                                            Ca làm việc
                                        </th>
                                        <th>
                                            Nhân viên
                                        </th>
                                        <th>
                                            Chuyên môn
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
                                            <?php echo $value->day ?>
                                        </td>
                                        <td>
                                            <?php echo $value->shifts ?>
                                        </td>
                                        <td>
                                            <?php echo $value->name ?>
                                        </td>
                                        <td>
                                            <?php echo $value->title ?>
                                        </td>
                                        <td>
                                            <div class="button-edit-delete">
                                                <div class="btn-edit-pre">
                                                    <a class="btn-edit"
                                                        href="./calendar.php?id_cal=<?php echo $value->id_cal ?>"><i
                                                            class="fas fa-edit"></i></a>
                                                </div>
                                                <div class="btn-delete-pre">
                                                    <a class="btn-delete"
                                                        href="./calendar.php?delete=<?php echo $value->id_cal ?>"
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
                    <h1>Thêm thông tin lịch làm việc</h1>
                    <a class="close-add" href="#"><i class="fas fa-times"></i></a>
                </div>
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="flex-time-day">
                        <div class="check-box-time">
                            <input type="checkbox" id="vehicle1" name="day" value="Thứ 2">
                            <label for="vehicle1"> Thứ 2</label><br>
                            <input type="checkbox" id="vehicle2" name="day" value="Thứ 3">
                            <label for="vehicle2"> Thứ 3</label>
                        </div>
                        <div class="check-box-time">
                            <input type="checkbox" id="vehicle3" name="day" value="Thứ 4">
                            <label for="vehicle3"> Thứ 4</label><br>
                            <input type="checkbox" id="vehicle1" name="day" value="Thứ 5">
                            <label for="vehicle1"> Thứ 5</label>
                        </div>
                        <div class="check-box-time">
                            <input type="checkbox" id="vehicle2" name="day" value="Thứ 6">
                            <label for="vehicle2"> Thứ 6</label><br>
                            <input type="checkbox" id="vehicle3" name="day" value="Thứ 7">
                            <label for="vehicle3"> Thứ 7</label>
                        </div>
                    </div>
                    <div class="flex-shifts">
                        <div class="shifts-time">
                            <input type="checkbox" id="vehicle2" name="shifts" value="Ca sáng">
                            <label for="vehicle2"> Sáng</label><br>
                        </div>
                        <div class="shifts-time">
                            <input type="checkbox" id="vehicle2" name="shifts" value="ca chiều">
                            <label for="vehicle2"> Chiều</label><br>
                        </div>
                        <div class="shifts-time">
                            <input type="checkbox" id="vehicle2" name="shifts" value="Cả ngày">
                            <label for="vehicle2"> Cả ngày</label><br>
                        </div>
                    </div>
                    <div class="select-time-all">
                        <div class="select-time">
                            <p>Nhân viên</p>
                            <select name="id_employee_t" id="id_employee_t" class="id_employee_t">
                                <?php foreach ($result2 as $key => $value) { ?>
                                <option value="<?php echo $value->id_employee ?>"><?php echo $value->name ?> -
                                    <?php echo $value->title ?></option>
                                <?php } ?>
                            </select>
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
                        <textarea class="desc-infor" value="" name="descc"
                            id="descc"><?php echo $result_edit->content ?></textarea>
                    </div>
                    <div class="group-infor">
                        <p class="status-img">Trạng thái</p>
                        <select name="status_about" id="status_about" class="status_about">
                            <option value="0" <?php if ($result_edit->status_about == 0) echo "selected" ?>>Ẩn</option>
                            <option value="1" <?php if ($result_edit->status_about == 1) echo "selected" ?>>Hiện
                            </option>
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