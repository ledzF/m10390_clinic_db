<?php
$host = "mysql1.serv00.com";     /SQL HOST of serv00/
$user = "m10390_clinic";        /Username/
$pass = "tRKZN6p.zN)S.iJbDBYQO37<%8TQrr";         /Password of User_db/
$db   = "m10390_clinic_db";    /Db Name/

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);   /Log/
}
?>
