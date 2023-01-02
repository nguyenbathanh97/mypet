<?php
include '../include/config.php';
    $sql_booking = "SELECT id, title FROM sevice";
    $query_booking = $conn->prepare($sql_booking);
    $query_booking->execute();
    $data = $query_booking->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($data);
?>