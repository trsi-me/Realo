<?php
// إعدادات الاتصال بقاعدة البيانات
$db_host = 'localhost';
$db_name = 'realo';
$db_user = 'root';
$db_pass = '';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die('فشل الاتصال بقاعدة البيانات');
}

mysqli_set_charset($conn, 'utf8mb4');
?>
