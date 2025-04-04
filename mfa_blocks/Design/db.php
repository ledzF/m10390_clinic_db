<?php
$host = "mysql1.serv00.com";     // ← replace with your actual SQL host
$user = "m10390_clinic";        // ← replace with your SQL username
$pass = "tRKZN6p.zN)S.iJbDBYQO37<%8TQrr";         // ← use the password you set
$db   = "m10390_clinic_db";    // ← your database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
