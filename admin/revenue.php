<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';

if (isset($_POST['btn-revenue']) && ($_POST['btn-revenue'])) {
    $from = $_POST['date-from-revenue'];
    $to = $_POST['date-to-revenue'];
    $sql = "SELECT SUM(total) as total_new, COUNT(id) as order_count FROM order_od WHERE created BETWEEN '$from' AND '$to'";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
}
if (isset($_POST['btn-revenue']) && ($_POST['btn-revenue'])) {
    $from = $_POST['date-from-revenue'];
    $to = $_POST['date-to-revenue'];
    $sql_s = "SELECT COUNT(b.id) as count_product FROM order_od a join order_detail b ON a.id = b.order_id WHERE (a.created BETWEEN '$from' AND '$to') AND (b.status_detail NOT IN (4)) ";
    $query_s = $conn->prepare($sql_s);
    $query_s->execute();
    $result_s = $query_s->fetch(PDO::FETCH_OBJ);
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
                            <h1>Quản lý doanh thu</h1><i class="fas fa-paw"></i>
                        </div>
                    </div>
                    <form action="" method="POST" enctype='multipart/form-data'>
                        <div class="date-revenue">
                            <div class="date-from">
                                <p>Từ ngày:</p>
                                <input type="date" name="date-from-revenue" id="date-from-revenue">
                            </div>
                            <div class="date-to">
                                <p>Đến ngày:</p>
                                <input type="date" name="date-to-revenue" id="date-to-revenue">
                            </div>
                        </div>
                        <div class="show-revenue">
                            <div class="date-to-from">
                                <?php if (isset($_POST['btn-revenue'])) { ?>
                                <p>Doanh thu từ <span><?php echo $from ?></span> ngày đến ngày
                                    <span><?php echo $to ?></span>
                                </p>
                                <?php } else { ?>
                                <p>Doanh thu từ ngày <span>năm/tháng/ngày</span> đến ngày
                                    <span>năm/tháng/ngày</span>
                                </p>
                                <?php } ?>
                            </div>
                            <div class="total-order-re">
                                <?php if (isset($_POST['btn-revenue'])) { ?>
                                <p>Tổng số lượng sản phẩm: <span><?php echo $result_s->count_product ?></span> (Sản
                                    phẩm)</p>
                                <?php } else { ?>
                                <p>Tổng số lượng sản phẩm: <span>0</span> (Sản phẩm)</p>
                                <?php } ?>
                            </div>
                            <div class="total-order-detail-re">
                                <?php if (isset($_POST['btn-revenue'])) { ?>
                                <p>Tổng số đơn hàng: <span><?php echo $result->order_count ?></span> (Đơn hàng)
                                </p>
                                <?php } else { ?>
                                <p>Tổng số đơn hàng: <span>0</span> (Đơn hàng)</p>
                                <?php } ?>
                            </div>
                            <div class="total-money-re">
                                <?php if (isset($_POST['btn-revenue'])) { ?>
                                <p>Tổng doanh thu:
                                    <span><?php echo number_format($result->total_new, 0, ",", ".") ?></span>
                                    (VNĐ)
                                </p>
                                <?php } else { ?>
                                <p>Tổng doanh thu:
                                    <span><?php echo number_format(0, 0, ",", ".") ?></span>
                                    (VNĐ)
                                </p>
                                <?php } ?>
                            </div>
                            <div class="btn-edit-in">
                                <input type="submit" name="btn-revenue" value="Thực hiện" class="btn-edit-form">
                            </div>
                        </div>
                    </form>
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