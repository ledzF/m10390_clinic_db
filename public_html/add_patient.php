<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $disease = $_POST['disease'];
    $contact = $_POST['contact'];

    $sql = "INSERT INTO patients (name, age, disease, contact) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siss", $name, $age, $disease, $contact);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Patient Added Successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('❌ Error Adding Patient');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Patient</title>
</head>
<body>
    <h2>Add New Patient</h2>
    <form method="POST">
        Name: <input type="text" name="name" required><br><br>
        Age: <input type="number" name="age" required><br><br>
        Disease: <input type="text" name="disease" required><br><br>
        Contact: <input type="text" name="contact" required><br><br>
        <button type="submit">➕ Add Patient</button>
    </form>
    <br>
    <a href="dashboard.php">🔙 Back to Dashboard</a>
</body>
</html>
