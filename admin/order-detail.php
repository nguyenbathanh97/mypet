<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // var_dump($id);
    // exit;
    $sql = "SELECT a.id as id_detail, b.title, a.image, a.quantity, a.price_detail, a.created, a.last_update, a.complate, a.status_detail FROM order_detail a join shop b ON a.shop_id_order = b.id_shop join order_od c ON a.order_id = c.id WHERE c.id = $id";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    if (isset($_REQUEST['id_detail']) && ($_REQUEST['id_detail'])) {
        $id_od1 = intval($_GET['id_detail']);
        $sql1 = "UPDATE order_detail SET status_detail = 1 WHERE id = $id_od1";
        $query1 = $conn->prepare($sql1);
        $query1->execute();
        if ($query1) {
            header("Location: ./order-detail.php?id=$id");
        }
    };
    if (isset($_REQUEST['id_detail1']) && ($_REQUEST['id_detail1'])) {
        $id_od2 = intval($_GET['id_detail1']);
        $sql2 = "UPDATE order_detail SET status_detail = 2 WHERE id = $id_od2";
        $query2 = $conn->prepare($sql2);
        $query2->execute();
        if ($query2) {
            header("Location: ./order-detail.php?id=$id");
        }
    };
    if (isset($_REQUEST['id_detail2']) && ($_REQUEST['id_detail2'])) {
        $id_od3 = intval($_GET['id_detail2']);
        $sql3 = "UPDATE order_detail SET complate = now(), status_detail = 3 WHERE id = $id_od3";
        $query3 = $conn->prepare($sql3);
        $query3->execute();
        if ($query) {
            header("Location: ./order-detail.php?id=$id");
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
                            <h1>Đơn hàng chi tiêt</h1><i class="fas fa-paw"></i>
                        </div>
                    </div>
                    <div class="form-infor">
                        <form class="product_detail_form1" action="" method="POST" enctype='multipart/form-data'>
                            <table id="my-table-detail" cellpadding="2" cellspacing="2">
                                <thead>
                                    <tr>
                                        <th>
                                            STT
                                        </th>
                                        <th>
                                            Tên sản phẩm
                                        </th>
                                        <th>
                                            Ảnh sản phẩm
                                        </th>
                                        <th>
                                            Đơn giá
                                        </th>
                                        <th>
                                            Số lượng
                                        </th>
                                        <th>
                                            Thành tiền
                                        </th>
                                        <th>
                                            Ngày đặt
                                        </th>
                                        <th>
                                            Ngày hủy
                                        </th>
                                        <th>
                                            Hoàn thành
                                        </th>
                                        <th>
                                            Trạng thái
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $key => $value) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $key + 1 ?>
                                        </td>
                                        <td class="name-product-detail">
                                            <?php echo $value->title ?>
                                        </td>
                                        <td>
                                            <img style="width: 80px; height: 80px ;" src=".<?php echo $value->image ?>"
                                                alt="image">
                                        </td>
                                        <td>
                                            <?php echo $value->price_detail ?>
                                        </td>
                                        <td>
                                            <?php echo $value->quantity ?>
                                        </td>
                                        <td>
                                            <?php echo $value->price_detail * $value->quantity ?>
                                        </td>
                                        <td>
                                            <?php echo $value->created ?>
                                        </td>
                                        <?php if ($value->status_detail != 4) { ?>
                                        <td>
                                            <?php echo "Chưa hủy" ?>
                                        </td>
                                        <?php } else { ?>
                                        <td>
                                            <?php echo $value->last_update ?>
                                        </td>
                                        <?php } ?>
                                        <?php if ($value->status_detail != 3) { ?>
                                        <td>
                                            <?php echo "Chưa hoàn thành" ?>
                                        </td>
                                        <?php } else { ?>
                                        <td>
                                            <?php echo $value->complate ?>
                                        </td>
                                        <?php } ?>
                                        <td class="change_order">
                                            <?php if ($value->status_detail == 4) { ?>
                                            <?php echo "Đã hủy" ?>
                                            <?php } elseif ($value->status_detail == 0) { ?>
                                            <a href="./order-detail.php?id=<?php echo $id ?>&id_detail=<?php echo $value->id_detail ?>"
                                                onclick="return confirm('Bạn có chắc chắn muốn xác nhận đơn hàng?');"><?php echo "Chưa xác nhận" ?></a>
                                            <?php } elseif ($value->status_detail == 1) { ?>
                                            <a href="./order-detail.php?id=<?php echo $id ?>&id_detail1=<?php echo $value->id_detail ?>"
                                                onclick="return confirm('Bạn có chắc chắn muốn xác nhận đơn hàng đang vận chuyển?');"><?php echo "Đã xác nhận" ?></a>
                                            <?php } elseif ($value->status_detail == 2) { ?>
                                            <a href="./order-detail.php?id=<?php echo $id ?>&id_detail2=<?php echo $value->id_detail ?>"
                                                onclick="return confirm('Bạn có chắc chắn muốn xác nhận đơn hàng đã hoàn thành?');"><?php echo "Đang vận chuyển" ?></a>
                                            <?php } elseif ($value->status_detail == 3) { ?>
                                            <?php echo "Đã hoàn thành" ?>
                                            <?php } ?>
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