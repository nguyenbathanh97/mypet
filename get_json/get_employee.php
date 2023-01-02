<?php
include '../include/config.php';
$id_sevice=0;
if (isset($_GET['id_sevice'])==true) $id_sevice = $_GET['id_sevice'];
    settype($id_sevice, "int");
    $sql_booking = "SELECT * FROM employee WHERE id_sevice=?";
    $query_booking = $conn->prepare($sql_booking);
    $query_booking->execute([$id_sevice]);
    $data = $query_booking->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($data);
?>
