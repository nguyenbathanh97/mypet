<?php
// Database connection
include '../include/slug.php';
include '../include/config.php';

$sqlSl_sv = "SELECT * FROM comment a join shop b on a.id_shop_fk = b.id_shop";
$query_sv = $conn->prepare($sqlSl_sv);
$query_sv->execute();
$result_sv = $query_sv->fetchAll(PDO::FETCH_OBJ);
if (isset($_REQUEST['delete_sv']) && ($_REQUEST['delete_sv'])) {
    $delete_sv = intval($_GET['delete_sv']);
    //     var_dump($delete_sv);
    // die();
    $sql_sv = "DELETE FROM comment WHERE id_comment = $delete_sv";
    $query_sv = $conn->prepare($sql_sv);
    $query_sv->execute();
    if ($query_sv) {
        header("Location: ./comment.php");
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
    <title>Bình luận</title>
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
                    <div class="title-show-top-1">
                        <div class="add-infor add-slider1">
                        </div>
                        <div class="title-show-top title-show-top2"><i class="fas fa-paw"></i>
                            <h1>Quản lý bình luận</h1><i class="fas fa-paw"></i>
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
                                            Nội dung
                                        </th>
                                        <th>
                                            Sản phẩm
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
                                            <?php echo $value->content_comment ?>
                                            </td>
                                            <td>
                                            <?php echo $value->title ?>
                                            </td>
                                            <td>
                                                <div class="button-edit-delete">
                                                    <div class="btn-delete-pre">
                                                        <a class="btn-delete" href="./comment.php?delete_sv=<?php echo $value->id_comment ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');"><i class="fas fa-trash-alt"></i></a>
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
</script>
<script>
    CKEDITOR.replace('desc');
    CKEDITOR.replace('descc');
</script>

</html>