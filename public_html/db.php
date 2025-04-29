<?php
$host = "mysql1.serv00.com";     // host
$user = "m10390_clinic";        // sql username in which we have created database
$pass = "lk2kdjp2v9-e;1RURTk$7T}LIp2Dbp";         // username - password
$db   = "m10390_test";    // database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);      // visit exploit.serv00.net/A/db.php if blank then connected, connection failed in any error. means either username password is incorrect
}
?>
