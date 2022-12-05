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
    $sql = "DELETE FROM content WHERE id = $delete";
    $query = $conn->prepare($sql);
    $query->execute();
    if ($query) {
        header("Location: ./content.php");
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
    <link rel="stylesheet" href="style.css">
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
                    <h1 class="title-infor">
                        Thông tin khách hàng liên hệ
                    </h1>
                    <div class="line-h1">
                        <div class="line-in"></div>
                        <i class="fas fa-star"></i>
                        <i class="center fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <div class="line-in"></div>
                    </div>
                    <div class="form-infor contact-table">
                        <form action="" method="POST">
                            <div class="table">
                                <div class="row blue">
                                    <div class="cell cell-title">
                                        STT
                                    </div>
                                    <div class="cell cell-title">
                                        Họ tên
                                    </div>
                                    <div class="cell cell-title">
                                        Emai
                                    </div>
                                    <div class="cell cell-title">
                                        Địa chỉ
                                    </div>
                                    <div class="cell cell-title">
                                        Điện thoại
                                    </div>
                                    <div class="cell cell-title cell-title-contact">
                                        Nội dung yêu cầu
                                    </div>
                                    <div class="cell cell-title">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                </div>
                                <?php foreach ($result as $key => $value) { ?>
                                    <div class="row">
                                        <div class="cell">
                                            <?php echo $key + 1 ?>
                                        </div>
                                        <div class="cell">
                                            <?php echo $value->name ?>
                                        </div>
                                        <div class="cell">
                                            <?php echo $value->email ?>
                                        </div>
                                        <div class="cell">
                                            <?php echo $value->address ?>
                                        </div>
                                        <div class="cell">
                                            <?php echo $value->phone ?>
                                        </div>
                                        <div class="cell">
                                            <?php echo $value->content ?>
                                        </div>
                                        <div class="cell cell-change">
                                            <div class="btn-edit-pre">
                                                <a class="btn-edit" href="./content-edit.php?id=<?php echo $value->id ?>">Sửa</a>
                                            </div>
                                            <div class="btn-delete-pre">
                                                <a class="btn-delete" href="./content.php?delete=<?php echo $value->id ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
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
<script type="text/javascript" src="main-admin.js"></script>
</html>