<?php
if(!isset($_SESSION)){
  session_start();
}
$host = 'localhost';
$username = "root";
$password = "";
$database = "mypet";
$message = "";

try {
  $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Kết nối thành công";
} catch(PDOException $e) {
  // echo "Kết lỗi không thành công: " . $e->getMessage();
}
?>