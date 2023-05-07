<?php
include './include/config.php';

// if (isset($_GET['action'])) {
//     var_dump($_POST);
//     exit;
// }
if (isset($_SESSION['logins']['id'])) {
    $idadd = ($_SESSION['logins']['id']);
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
$price = 0;
$total = 0;
$err = false;
$err1 = false;
$err2 = false;
$sussecc = false;
if (isset($_GET['action'])) {
    function update_cart($add = false)
    {
        foreach ($_POST['quantity'] as $id => $quantity) {
            if ($quantity == 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                if ($add) {
                    $_SESSION['cart'][$id] += $quantity;
                } else {
                    $_SESSION['cart'][$id] = $quantity;
                }
            }
        }
    }
    switch ($_GET['action']) {
        case 'add':
            update_cart(true);
            header('location: ./cart.php');
            break;
        case 'delete':
            if (isset($_GET['id_shop'])) {
                unset($_SESSION['cart'][$_GET['id_shop']]);
            }
            header('location: ./cart.php');
            break;
        case 'submit':
            if (isset($_POST['click_update'])) {
                update_cart();
                header('location: ./cart.php');
            } elseif ($_POST['btn_book']) {
                if (empty($_POST['name'])) {
                    $err = 'Bạn chưa nhập tên người nhận!';
                } elseif (empty($_POST['phone'])) {
                    $err1 = 'Bạn chưa nhập số điện thoại!';
                } elseif (empty($_POST['address'])) {
                    $err2 = 'Bạn chưa nhập địa chỉ nhận hàng!';
                }
                if ($err == false && $err1 == false && $err2 == false) {
                    $sqladd = "SELECT * FROM shop WHERE id_shop in (" . implode(",", array_keys($_POST['quantity'])) . ")";
                    $queryadd = $conn->prepare($sqladd);
                    $queryadd->execute();
                    $resultadd = $queryadd->fetchAll(PDO::FETCH_OBJ);
                    $totaladd = 0;
                    $totaladd1 = 0;
                    $price1 = 0;
                    // var_dump($resultadd);
                    // exit;
                    $product = array();
                    foreach ($resultadd as $key => $value) {
                        $product[] = $value;
                        // var_dump($product);
                        // exit;
                        if ($value->promotion > 0) {
                            $price1 = $value->promotion;
                        } else {
                            $price1 = $value->price;
                        }
                        $totaladd = $price1 * $_POST['quantity'][$value->id_shop];
                        $totaladd1 += $totaladd;
                    }
                    // var_dump($totaladd1);
                    // exit;
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $note = $_POST['note'];
                    $sqladd1 = "INSERT INTO order_od ( name, phone, address, total, note, created, last_update, id_user_fk) VALUES ( :name, :phone, :address, $totaladd1, :note, now(), now(), $idadd)";
                    $queryadd1 = $conn->prepare($sqladd1);
                    $queryadd1->bindParam(':name', $name, PDO::PARAM_STR);
                    $queryadd1->bindParam(':phone', $phone, PDO::PARAM_STR);
                    $queryadd1->bindParam(':address', $address, PDO::PARAM_STR);
                    $queryadd1->bindParam(':note', $note, PDO::PARAM_STR);
                    $queryadd11 = $queryadd1->execute();
                    $order_id = $conn->lastInsertId();
                    // var_dump($order_id);
                    // exit;
                    // $sqladd2 = "SELECT * FROM shop WHERE id_shop in (" . implode(",", array_keys($_POST['quantity'])) . "),";
                    // $queryadd2 = $conn->prepare($sqladd2);
                    // $queryadd2->execute();
                    // $resultadd2 = $queryadd2->fetch(PDO::FETCH_OBJ);
                    $price2 = 0;
                    $values_query = "";
                    $num = 0;
                    foreach ($product as $key => $value) {
                        // var_dump($value);
                        // exit;
                        if ($value->promotion > 0) {
                            $price2 = $value->promotion;
                        } else {
                            $price2 = $value->price;
                        }
                        $values_query .= "('" . $order_id . "', '" . $value->id_shop . "', '" . $_POST['quantity'][$value->id_shop] . "', '" . $price2 . "', '" . $value->image . "',  now() , now(), 0 )";
                        if ($key != count($product) - 1) {
                            $values_query .= ",";
                        }
                    }
                    // var_dump($values_query);
                    // exit;
                    $sqladd2 = "INSERT INTO order_detail (order_id, shop_id_order, quantity, price_detail, image, created, last_update, status_detail) VALUES " . $values_query . "";
                    $queryadd2 = $conn->prepare($sqladd2);
                    $queryadd2 = $queryadd2->execute();
                    $sussecc = "Đặt hàng thành công!";
                    unset($_SESSION['cart']);
                }
            }
            break;
    }
}
if (!empty($_SESSION['cart'])) {
    $sql = "SELECT * FROM shop Where id_shop in (" . implode(",", array_keys($_SESSION['cart'])) . ")";
    $query = $conn->prepare($sql);
    $query->execute();
    $resultt = $query->fetchAll(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
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
    <div class="main-cart">
        <div class="container">
            <div class="cart-h2">
                <h2>Đơn hàng của bạn</h2>
            </div>
            <?php if (!empty($_SESSION['cart'])) { ?>
            <form id="cart-form" action="cart.php?action=submit" method="POST">
                <table id="my-table-cart">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultt as $key => $value) { ?>
                        <tr class="table-cart">
                            <td class="css-td"><?php echo $key + 1 ?></td>
                            <td class="css-title"><?php echo $value->title ?></td>
                            <td><img src="<?php echo $value->image ?>" alt="image"></td>
                            <td class="css-td"><?php if ($value->promotion > 0) {
                                                            echo number_format($price = $value->promotion, 0, ",", ".") . ' VNĐ';
                                                        } else {
                                                            echo number_format($price = $value->price, 0, ",", ".") . ' VNĐ';
                                                        } ?></td>
                            <td><input type="number" name="quantity[<?php echo $value->id_shop ?>]"
                                    value="<?php echo $_SESSION['cart'][$value->id_shop] ?>" class="quantity" min="1">
                            </td>
                            <td class="css-td">
                                <?php $monney_total = $price * $_SESSION['cart'][$value->id_shop] ?>
                                <?php echo number_format($monney_total, 0, ",", ".") . ' VNĐ' ?>
                            </td>
                            <td class="css-td"><a href="cart.php?action=delete&id_shop=<?php echo $value->id_shop ?>"><i
                                        class="delete-icon fas fa-trash-alt"></i></a></td>
                        </tr>
                        <?php $total += $monney_total; ?>
                        <?php } ?>

                    </tbody>
                </table>
                <h5 class="total-money">Tổng tiền:
                    <span><?php echo number_format($total, 0, ",", ".") . ' VNĐ' ?></span>
                </h5>
                <div class="update_cart">
                    <input type="submit" value="Cập nhật" name="click_update">
                </div>
                <div class="cart-info">
                    <div class="group-cart">
                        <h5>Người nhận:</h5>
                        <div class="group-cart-chil">
                            <input type="text" name="name" value="<?php echo $_SESSION['logins']['name'] ?>"
                                class="name" id="name">
                            <p><?php echo $err ?></p>
                        </div>
                    </div>
                    <div class="group-cart">
                        <h5>Điện thoại:</h5>
                        <div class="group-cart-chil">
                            <input type="phone" name="phone" value="<?php echo $_SESSION['logins']['phone'] ?>"
                                class="phone" id="phone">
                            <p><?php echo $err1 ?></p>
                        </div>
                    </div>
                    <div class="group-cart">
                        <h5>Địa chỉ:</h5>
                        <div class="group-cart-chil">
                            <input type="text" name="address" value="<?php echo $_SESSION['logins']['address'] ?>"
                                class="address" id="address">
                            <p><?php echo $err2 ?></p>
                        </div>
                    </div>
                    <div class="group-cart">
                        <h5>Ghi chú:</h5>
                        <div class="group-cart-chil">
                            <textarea name="note" id="note" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="book-cart">
                        <input type="submit" value="Đặt hàng" name="btn_book" class="btn_book" id="btn_book">
                    </div>
                </div>
                <?php } else { ?>
                <h5 class="sussess_cart"><?php if (!empty($sussecc)) {
                                                    echo $sussecc;
                                                } ?></h5>
                <p class="cart-emty">Xin chào <?php echo $_SESSION['logins']['name'] ?> hiện tại giỏ hàng của bạn đang
                    rỗng!
                </p>
                <?php } ?>
            </form>
        </div>
    </div>
    <!-- footer  -->
    <?php
    include "./include/footer.php";
    ?>
    <!-- /footer  -->
</body>
<!-- <script src="./js/validator.js"></script>
<script>
Validator({
    form: '#form-comment',
    formGroupSelector: '.group-comment',
    errorSelector: "#display-commnet-message",
    rules: [
        Validator.isRequired('#comment-text', 'Vui lòng nhập nội dung!'),
    ],
});
</script> -->
<script src="./js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $("#my-table-cart").DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
        },
        pageLength: 10,
        lengthMenu: [1, 2, 3, 4, 5, 10, 15, 20, 30, 50, 100],
    });
});
</script>

</html>