<?php
include './include/config.php';
unset($_SESSION['logins']);
header('location: ./index.php');