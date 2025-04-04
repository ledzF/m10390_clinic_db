<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clinic Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
    <ul>
        <li><a href="add_patient.php">➕ Add Patient</a></li>
        <li><a href="view_patients.php">📋 View Patients</a></li>
        <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
</body>
</html>
