<?php
include './include/slug.php';
include './include/config.php';
$id_user = $_COOKIE['logins_id'];
$sqlSl = "SELECT * FROM booking a join sevice b on a.id_sevice = b.id  join employee c on a.id_employee_f = c.id_employee WHERE id_user_fk = $id_user ";
$query = $conn->prepare($sqlSl);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin lịch khám</title>
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
    <div class="main-infor-booking">
        <div class="container">
            <h2 class="booking-infor">Lịch khám của tôi</h2>
            <div class="show-infor-booking">
                <table id="my-infor-booking">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Điện thoại</th>
                            <th>Email</th>
                            <th>Loại dịch vụ</th>
                            <th>Bác sĩ</th>
                            <th>Thời gian</th>
                            <th>nội dung yêu cầu</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $key => $value) { ?>
                        <tr class="table-infor-booking">
                            <td class="line_booking"><?php echo $key + 1 ?></td>
                            <td class="line_booking_name line_infor_line1"><?php echo $value->name_bk ?></td>
                            <td class="line_infor_line1"><?php echo $value->phone ?></td>
                            <td class="line_infor_line1"><?php echo $value->email ?></td>
                            <td class="line_infor_line1"><?php echo $value->title ?></td>
                            <td class="line_infor_line1"><?php echo $value->name ?></td>
                            <td class="line_infor_line1"><?php echo $value->date ?></td>
                            <td class="line_infor_line1"><?php echo $value->content_booking ?></td>
                            <?php if ($value->status_bk == 0) { ?>
                            <td class="line_infor_line1 line_booking"><?php echo "Chưa xác nhận" ?></td>
                            <?php } elseif ($value->status_bk == 1) { ?>
                            <td class="line_infor_line1 line_booking"><?php echo "Đã xác nhận" ?></td>
                            <?php } else { ?>
                            <td class="line_infor_line1 line_booking"><?php echo "Đã hoàn thành" ?></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
        $("#my-infor-booking").DataTable({
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