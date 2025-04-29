<?php
session_start();
include 'db.php';  // database connection

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM patients WHERE id=?";        // gets id of selected patient and runs this query to deleete that particular.
$stmt = $conn->prepare($sql);     // this prepares a query using database connection preventing from SQL injection
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('✅ Patient Deleted Successfully!'); window.location.href='../view_patients.php';</script>";
} else {
    echo "<script>alert('❌ Error Deleting Patient');</script>";
}
?>

