<?php
include './include/config.php';

// if (isset($_GET['action'])) {
//     var_dump($_POST);
//     exit;
// }
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            foreach ($_POST['quantity'] as $id => $quantity) {
                $_SESSION['cart'][$id] = $quantity;
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
            <?php $cart = count($_SESSION['cart']) ?>
            <?php if ($cart >= 1) { ?>
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
                            <td class="css-td"><?php echo $value->price . ' VNĐ' ?></td>
                            <td><input type="number" name="quantity[<?php echo $value->id_shop ?>]"
                                    value="<?php echo $_SESSION['cart'][$value->id_shop] ?>" class="quantity"></td>
                            <td class="css-td">
                                <?php echo $value->price * $_SESSION['cart'][$value->id_shop] . ' VNĐ' ?>
                            </td>
                            <td class="css-td">xóa</td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <h5 class="total-money">Tổng tiền: <span>5000000</span></h5>
                <div class="update_cart">
                    <input type="button" value="Cập nhật">
                </div>
                <div class="cart-info">
                    <div class="group-cart">
                        <h5>Người nhận:</h5>
                        <div class="group-cart-chil">
                            <input type="text" name="name" class="name" id="name">
                            <p>Bạn phải nhập họ tên</p>
                        </div>
                    </div>
                    <div class="group-cart">
                        <h5>Điện thoại:</h5>
                        <div class="group-cart-chil">
                            <input type="phone" name="phone" class="phone" id="phone">
                            <p>Bạn phải nhập họ tên</p>
                        </div>
                    </div>
                    <div class="group-cart">
                        <h5>Địa chỉ:</h5>
                        <div class="group-cart-chil">
                            <input type="text" name="address" class="address" id="address">
                            <p>Bạn phải nhập họ tên</p>
                        </div>
                    </div>
                    <div class="group-cart">
                        <h5>Ghi chú:</h5>
                        <div class="group-cart-chil">
                            <textarea name="note" id="note" cols="30" rows="10"></textarea>
                            <p>Bạn phải nhập họ tên</p>
                        </div>
                    </div>
                    <div class="book-cart">
                        <input type="submit" value="Đặt hàng" name="btn_book" class="btn_book" id="btn_book">
                    </div>
                </div>
            </form>
            <?php } else { ?>
            <p class="cart-emty">Xin chào <?php echo $_SESSION['logins']['name'] ?> hiện tại đơn hàng của bạn đang rỗng!
            </p>
            <?php } ?>
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