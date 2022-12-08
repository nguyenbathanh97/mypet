<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';

$sqlSl = "SELECT * FROM contact";
$query = $conn->prepare($sqlSl);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
if (isset($_REQUEST['delete']) && ($_REQUEST['delete'])) {
    $delete = intval($_GET['delete']);
    $sql = "DELETE FROM contact WHERE id = $delete";
    $query = $conn->prepare($sql);
    $query->execute();
    if ($query) {
        header("Location: ./contact.php");
    } else {
        echo "Lỗi!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
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
                    <div class="title-show-top title-show-top2"><i class="fas fa-paw"></i>
                        <h1>Quản lý khách hàng liên hệ</h1><i class="fas fa-paw"></i>
                    </div>
                    <div class="form-infor contact-table">
                        <form action="" method="POST">
                            <table id="my-table" cellpadding="2" cellspacing="2">
                                <thead>
                                    <tr>
                                        <th>
                                            STT
                                        </th>
                                        <th class="name-contact-th">
                                            Họ tên
                                        </th>
                                        <th>
                                            Emai
                                        </th>
                                        <th>
                                            Địa chỉ
                                        </th>
                                        <th class="phone-contact-th">
                                            Điện thoại
                                        </th>
                                        <th class="content-contact-th">
                                            Nội dung yêu cầu
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
                                                <?php echo $value->name ?>
                                            </td>
                                            <td>
                                                <?php echo $value->email ?>
                                            </td>
                                            <td>
                                                <?php echo $value->address ?>
                                            </td>
                                            <td>
                                                <?php echo $value->phone ?>
                                            </td>
                                            <td>
                                                <?php echo $value->content ?>
                                            </td>
                                            <td>
                                                <div class="btn-delete-pre">
                                                    <a class="btn-delete" href="./contact.php?delete=<?php echo $value->id ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');"><i class="fas fa-trash-alt"></i></a>
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