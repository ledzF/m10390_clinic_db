<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM patients WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('✅ Patient Deleted Successfully!'); window.location.href='view_patients.php';</script>";
} else {
    echo "<script>alert('❌ Error Deleting Patient');</script>";
}
?>
