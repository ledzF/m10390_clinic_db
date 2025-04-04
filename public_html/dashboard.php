<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clinic Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { margin-top: 50px; }
        .btn { display: inline-block; padding: 10px 20px; margin: 10px; text-decoration: none; color: white; background-color: #4CAF50; border-radius: 5px; }
        .btn:hover { background-color: #45a049; }
        .logout { background-color: #f44336; }
        .logout:hover { background-color: #d32f2f; }
    </style>
</head>
<body>
    <h1>🏥 Clinic Management Dashboard</h1>
    <div class="container">
        <a href="add_patient.php" class="btn">➕ Add Patient</a>
        <a href="view_patients.php" class="btn">📋 View Patients</a>
        <a href="logout.php" class="btn logout">🚪 Logout</a>
    </div>
</body>
</html>
