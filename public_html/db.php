<?php
$host = "mysql1.serv00.com";     // ← replace with your actual SQL host
$user = "m10390_clinic";        // ← replace with your SQL username
$pass = "lk2kdjp2v9-e;1RURTk$7T}LIp2Dbp";         // ← use the password you set
$db   = "m10390_clinic_db";    // ← your database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
