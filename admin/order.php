<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';


$sqlSl_sv = "SELECT * FROM order_od";
$query_sv = $conn->prepare($sqlSl_sv);
$query_sv->execute();
$result_sv = $query_sv->fetchAll(PDO::FETCH_OBJ);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT b.title, a.image, a.quantity, a.price_detail, a.created, a.last_update, a.complate, a.status_detail FROM order_detail a join shop b ON a.shop_id_order = b.id_shop join order_od c ON a.order_id = c.id WHERE c.id = $id";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    if (isset($_REQUEST['status_0']) && ($_REQUEST['status_0'])) {
        $id_od = intval($_GET['status_0']);
        $sql = "UPDATE order_detail SET status_detail = 1 WHERE id = $id_od";
        $query = $conn->prepare($sql);
        $query->execute();
        if ($query) {
            header("Location: ./order.php");
        }
    };
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng</title>
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
                        <div class="title-show-top title-show-detail"><i class="fas fa-paw"></i>
                            <h1>Quản lý đơn hàng</h1><i class="fas fa-paw"></i>
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
                                            Điện thoại
                                        </th>
                                        <th>
                                            Địa chỉ
                                        </th>
                                        <th>
                                            Tổng tiền
                                        </th>
                                        <th>
                                            Ghi chú
                                        </th>
                                        <th>
                                            Ngày đặt
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
                                            <?php echo $value->name ?>
                                        </td>
                                        <td>
                                            <?php echo $value->phone ?>
                                        </td>
                                        <td>
                                            <?php echo $value->address ?>
                                        </td>
                                        <td>
                                            <?php echo $value->total ?>
                                        </td>
                                        <td>
                                            <?php echo $value->note ?>
                                        </td>
                                        <td>
                                            <?php echo $value->created ?>
                                        </td>
                                        <td>
                                            <div class="button-edit-delete">
                                                <div class="btn-edit-pre">
                                                    <a class="btn-edit-order"
                                                        href="./order-detail.php?id=<?php echo $value->id ?>">Chi
                                                        tiết</a>
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
$(document).ready(function() {
    $("#my-table-detail").DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
        },
        pageLength: 4,
        lengthMenu: [1, 2, 3, 4, 5, 10, 15, 20, 30, 50, 100],
    });
});
</script>
<script>
CKEDITOR.replace('desc');
CKEDITOR.replace('descc');
</script>

</html>