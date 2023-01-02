<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';

$sqlSl = "SELECT * FROM booking a join sevice b on a.id_sevice = b.id  join employee c on a.id_employee_f = c.id_employee ORDER BY id_bk ASC ";
$query = $conn->prepare($sqlSl);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
if (isset($_REQUEST['status']) && ($_REQUEST['status'])) {
    $status = intval($_GET['status']);
    $sql = "UPDATE booking SET status_bk = 1 WHERE id_bk = $status";
    $query = $conn->prepare($sql);
    $query->execute();
    if ($query) {
        header("Location: ./booking.php");
    }
};
if (isset($_REQUEST['status_xn']) && ($_REQUEST['status_xn'])) {
    $status = intval($_GET['status_xn']);
    $sql = "UPDATE booking SET status_bk = 2 WHERE id_bk = $status";
    $query = $conn->prepare($sql);
    $query->execute();
    if ($query) {
        header("Location: ./booking.php");
    }
};
if (isset($_REQUEST['status_h']) && ($_REQUEST['status_h'])) {
    $status = intval($_GET['status_h']);
    $sql = "UPDATE booking SET status_bk = 1 WHERE id_bk = $status";
    $query = $conn->prepare($sql);
    $query->execute();
    if ($query) {
        header("Location: ./booking.php");
    }
};
if (isset($_REQUEST['del']) && ($_REQUEST['del'])) {
    $del = intval($_GET['del']);
    // var_dump($del);
    // die;
    $sql = "DELETE FROM booking WHERE id_bk = $del";
    $query = $conn->prepare($sql);
    $query->execute();
    if ($query) {
        header("Location: ./booking.php");
    } else {
        echo "<label>Lỗi</label>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lịch</title>
    <link href='//fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet' type='text/css' />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
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
            <div class="title-show-top"><i class="fas fa-paw"></i>
                <h1>Quản lý lịch hẹn khám</h1><i class="fas fa-paw"></i>
            </div>
            <div class="main-infor-chil">
                <div class="infor-container main-infor-chil-in">
                    <div class="form-infor contact-table">
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
                                            Điện thoại
                                        </th>
                                        <th>
                                            Emai
                                        </th>
                                        <th>
                                            Thời gian
                                        </th>
                                        <th>
                                            loại dịch vụ
                                        </th>
                                        <th>
                                            Bác sĩ
                                        </th>
                                        <th class="content-booking-th">
                                            Nội dung yêu cầu
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
                                    <?php foreach ($result as $key => $value) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $key + 1 ?>
                                            </td>
                                            <td>
                                                <?php echo $value->name_bk ?>
                                            </td>
                                            <td>
                                                <?php echo $value->phone ?>
                                            </td>
                                            <td>
                                                <?php echo $value->email ?>
                                            </td>
                                            <td>
                                                <?php echo $value->date ?>
                                            </td>
                                            <td>
                                                <?php echo $value->title ?>
                                            </td>
                                            <td>
                                                <?php echo $value->name ?>
                                            </td>
                                            <td class="content_bk">
                                                <?php echo $value->content_booking ?>
                                            </td>
                                            <th>
                                                <?php if ($value->status_bk == 0) { ?>
                                                    <a class="btn_booking_xn" href="./booking.php?status=<?php echo $value->id_bk ?>" onclick="return confirm('Bạn chắc chắn muốn xác nhận lịch?');">Chưa xác nhận</a>
                                                <?php }else if($value->status_bk == 1){ ?>
                                                    <a class="btn_booking_xn" href="./booking.php?status_xn=<?php echo $value->id_bk ?>" onclick="return confirm('Bạn chắc chắn muốn hủy lịch?');">Đã xác nhận</a>
                                                    <?php }else{ ?>
                                                        <a class="btn_booking_xn" href="./booking.php?status_h=<?php echo $value->id_bk ?>" onclick="return confirm('Bạn chắc chắn muốn xác nhận lại lịch?');">Đã hoàn thành</a>
                                                        <?php } ?>
                                            </th>
                                            <td>
                                                <div class="btn-delete-pre">
                                                    <a class="btn-delete" href="./booking.php?del=<?php echo $value->id_bk ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');"><i class="fas fa-trash-alt"></i></a>
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