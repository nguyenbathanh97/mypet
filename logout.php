<?php
include './include/config.php';
// unset($_SESSION['logins']);
setcookie("logins_id", $results->id, time() - 3600, '/');
setcookie("logins_username",  $results->username, time()  - 3600, '/');
setcookie("logins_password", $results->password, time()  - 3600, '/');
setcookie("logins_name", $results->name, time()  - 3600, '/');
setcookie("logins_email", $results->email, time()  - 3600, '/');
setcookie("logins_phone", $results->phone, time()  - 3600, '/');
setcookie("logins_address", $results->address, time()  - 3600, '/');
setcookie("logins_status", $results->status, time()  - 3600, '/');
header('location: ./index.php');