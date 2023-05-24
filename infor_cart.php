<?php
include './include/slug.php';
include './include/config.php';
if (isset($_COOKIE['logins_id'])) {
    $change = $_COOKIE['logins_id'];
    $sql_infor_cart = "SELECT c.created as created_od, b.id as id_detail, a.title, b.price_detail, b.image, b.quantity, b.status_detail, c.total  FROM shop a join order_detail b on a.id_shop = b.shop_id_order join order_od c on c.id = b.order_id  WHERE b.status_detail in(0, 1, 2) and  c.id_user_fk = $change";
    $query_infor_cart = $conn->prepare($sql_infor_cart);
    $query_infor_cart->execute();
    $result_infor_cart = $query_infor_cart->fetchAll(PDO::FETCH_OBJ);

    $sql_infor_cart1 = "SELECT b.last_update as update_cancel,a.title, b.price_detail, b.image, b.quantity, b.status_detail, c.total FROM shop a join order_detail b on a.id_shop = b.shop_id_order join order_od c on c.id = b.order_id  WHERE b.status_detail = 4 and c.id_user_fk = $change";
    $query_infor_cart1 = $conn->prepare($sql_infor_cart1);
    $query_infor_cart1->execute();
    $result_infor_cart1 = $query_infor_cart1->fetchAll(PDO::FETCH_OBJ);

    $sql_infor_cart2 = "SELECT * FROM shop a join order_detail b on a.id_shop = b.shop_id_order join order_od c on c.id = b.order_id  WHERE b.status_detail = 3 and c.id_user_fk = $change";
    $query_infor_cart2 = $conn->prepare($sql_infor_cart2);
    $query_infor_cart2->execute();
    $result_infor_cart2 = $query_infor_cart2->fetchAll(PDO::FETCH_OBJ);

    if (isset($_GET['id_detail']) && ($_GET['id_detail'])) {
        $id = $_GET['id_detail'];
        // var_dump($id);
        // exit;
        $show = "SELECT * FROM order_detail WHERE status_detail = 4 and id = $id";
        $query = $conn->prepare($show);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        $num = $result->order_id;
        // var_dump($num);
        // exit;
        $sql = "UPDATE order_detail SET status_detail = 4, last_update = now() WHERE id = $id";
        $query = $conn->prepare($sql);
        $query_excute = $query->execute();

        $show = "SELECT * FROM order_detail WHERE  id = $id";
        $query = $conn->prepare($show);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        $order_id = $result->order_id;
        $quantity = $result->quantity;
        $price_detail = $result->price_detail;


        $sql_order_od = "SELECT *  FROM  order_od WHERE id = $order_id";
        $query_order_od = $conn->prepare($sql_order_od);
        $query_order_od->execute();
        $result_order_od = $query_order_od->fetch(PDO::FETCH_OBJ);

        $toatl = $result_order_od->total;

        $totalNew = $toatl - ($quantity * $price_detail);

        $sql1 = "UPDATE order_od SET total = $totalNew WHERE id = $order_id ";
        $query1 = $conn->prepare($sql1);
        $query_excute1 = $query1->execute();

        if ($query_excute) {
            header('Location: ./infor_cart.php');
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
    <title>Thông tin đơn hàng</title>
    <!-- link css  -->
    <?php
    include "./include/link-css.php";
    ?>
    <!-- /link css  -->
</head>

<body>
    <!-- header -->
    <?php
    include "./include/header.php";
    ?>
    <!-- /header -->
    <div class="main-infor-cart">
        <div class="container">
            <div class="infor-cart">
                <div class="tab-chil">
                    <div class="tab-chil-all">
                        <button onclick="openTab(event,'show-tab1')" class="link active1">Đơn hàng của bạn</button>
                        <button class="link" onclick="openTab(event,'show-tab2')">Đơn hàng đã hủy</button>
                        <button class="link" onclick="openTab(event,'show-tab3')">Đơn hàng giao thành
                            công</button>
                    </div>
                </div>
                <div id="show-tab1" class="show-tab-1 active1">
                    <table id="my-infor-cart" class="tab-chil-show">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Hủy đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result_infor_cart as $key => $value) { ?>
                            <tr class="table-infor-cart">
                                <td class="line_infor_line-first"><?php echo $key + 1 ?></td>
                                <td class="line_infor_line1"><?php echo $value->title ?></td>
                                <td class="image-infor-cart"><img src="<?php echo $value->image ?>" alt="image">
                                </td>
                                <td class="line_infor_line">
                                    <?php echo number_format($value->price_detail, 0, ",", ".") . ' VNĐ' ?></td>
                                <td class="line_infor_line"><?php echo $value->quantity ?></td>
                                <td class="line_infor_line">
                                    <?php echo number_format($value->price_detail * $value->quantity, 0, ",", ".") . ' VNĐ' ?>
                                </td>
                                <td class="line_infor_line">
                                    <?php echo $value->created_od ?>
                                </td>
                                <td class="line_infor_line"><?php if ($value->status_detail == 0) { ?>
                                    <?php echo 'Chưa xác nhận'; ?>
                                    <?php } elseif ($value->status_detail == 1) { ?>
                                    <?php echo 'Đang chuẩn bị'; ?>
                                    <?php } elseif ($value->status_detail == 2) { ?>
                                    <?php echo 'Đang vận chuyển'; ?>
                                    <?php } elseif ($value->status_detail == 3) { ?>
                                    <?php echo 'Đã nhận hàng'; ?>
                                    <?php } elseif ($value->status_detail == 4) { ?>
                                    <?php echo 'Đã hủy'; ?>
                                    <?php } ?>
                                </td>
                                <td class="cancel_infor_cart line_infor_line"><?php if ($value->status_detail == 0) { ?>
                                    <a class="btn-submit-cancel"
                                        href="./infor_cart.php?id_detail=<?php echo $value->id_detail ?>"
                                        onclick="return confirm('Bạn chắc chắn muốn hủy đơn hàng không?');">Hủy</a>
                                    <?php } else { ?>
                                    <a class="btn-submit-cancel" href="./infor_cart.php"
                                        onclick="return confirm('Bạn không thể hủy đơn hàng!');">Hủy</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                </div>
                </table>
            </div>
            <div id="show-tab2" class="show-tab-1">
                <table id="my-infor-cart-cancel" class="tab-chil-show">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Ngày hủy</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result_infor_cart1 as $key => $value) { ?>
                        <tr class="table-infor-cart">
                            <td class="line_infor_line-first"><?php echo $key + 1 ?></td>
                            <td class="line_infor_line1"><?php echo $value->title ?></td>
                            <td class="image-infor-cart"><img src="<?php echo $value->image ?>" alt="image"></td>
                            <td class="line_infor_line">
                                <?php echo number_format($value->price_detail, 0, ",", ".") . ' VNĐ' ?>
                            </td>
                            <td class="line_infor_line"><?php echo $value->quantity ?></td>
                            <td class="line_infor_line">
                                <?php echo number_format($value->price_detail * $value->quantity, 0, ",", ".") . ' VNĐ' ?>
                            </td>
                            <td class="line_infor_line">
                                <?php echo $value->update_cancel ?>
                            </td>
                            <td class="line_infor_line">
                                <?php if ($value->status_detail == 0) { ?>
                                <?php echo 'Chưa xác nhận'; ?>
                                <?php } elseif ($value->status_detail == 1) { ?>
                                <?php echo 'Đang chuẩn bị'; ?>
                                <?php } elseif ($value->status_detail == 2) { ?>
                                <?php echo 'Đang vận chuyển'; ?>
                                <?php } elseif ($value->status_detail == 3) { ?>
                                <?php echo 'Đã nhận hàng'; ?>
                                <?php } elseif ($value->status_detail == 4) { ?>
                                <?php echo 'Đã hủy'; ?>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div id="show-tab3" class="show-tab-1">
                <table id="my-infor-cart-sus" class="tab-chil-show">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Ngày giao</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result_infor_cart2 as $key => $value) { ?>
                        <tr class="table-infor-cart">
                            <td class="line_infor_line-first"><?php echo $key + 1 ?></td>
                            <td class="line_infor_line1"><?php echo $value->title ?></td>
                            <td class="image-infor-cart"><img src="<?php echo $value->image ?>" alt="image"></td>
                            <td class="line_infor_line">
                                <?php echo number_format($value->price_detail, 0, ",", ".") . ' VNĐ' ?></td>
                            <td class="line_infor_line"><?php echo $value->quantity ?></td>
                            <td class="line_infor_line">
                                <?php echo number_format($value->price_detail * $value->quantity, 0, ",", ".") . ' VNĐ' ?>
                            </td>
                            <td class="line_infor_line">
                                <?php echo $value->complate ?>
                            </td>
                            <td class="line_infor_line"><?php if ($value->status_detail == 0) { ?>
                                <?php echo 'Chưa xác nhận'; ?>
                                <?php } elseif ($value->status_detail == 1) { ?>
                                <?php echo 'Đang chuẩn bị'; ?>
                                <?php } elseif ($value->status_detail == 2) { ?>
                                <?php echo 'Đang vận chuyển'; ?>
                                <?php } elseif ($value->status_detail == 3) { ?>
                                <?php echo 'Đã nhận hàng'; ?>
                                <?php } elseif ($value->status_detail == 4) { ?>
                                <?php echo 'Đã hủy'; ?>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <!-- footer  -->
    <?php
    include "./include/footer.php";
    ?>
    <!-- /footer  -->
    <script src="./js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#my-infor-cart").DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
            },
            pageLength: 5,
            lengthMenu: [1, 2, 3, 4, 5, 10, 15, 20, 30, 50, 100],
        });
        $("#my-infor-cart-cancel").DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
            },
            pageLength: 5,
            lengthMenu: [1, 2, 3, 4, 5, 10, 15, 20, 30, 50, 100],
        });
        $("#my-infor-cart-sus").DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
            },
            pageLength: 5,
            lengthMenu: [1, 2, 3, 4, 5, 10, 15, 20, 30, 50, 100],
        });
    });
    </script>
</body>

</html>