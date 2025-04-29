<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM patients WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];

    $update_sql = "UPDATE patients SET name=?, age=?, gender=?, contact=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sissi", $name, $age, $gender, $contact, $id);

    if ($update_stmt->execute()) {
        echo "<script>alert('✅ Patient Updated Successfully!'); window.location.href='view_patients.php';</script>";
    } else {
        echo "<script>alert('❌ Error Updating Patient');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>✏️ Edit Patient</h2>
    <form method="POST">
        Name: <input type="text" name="name" value="<?= $patient['name'] ?>" required><br><br>
        Age: <input type="number" name="age" value="<?= $patient['age'] ?>" required><br><br>
        Gender:
        <select name="gender" required>
            <option value="Male" <?= $patient['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= $patient['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
            <option value="Other" <?= $patient['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
        </select><br><br>
        Contact: <input type="text" name="contact" value="<?= $patient['contact'] ?>" required><br><br>
        <button type="submit">💾 Save Changes</button>
    </form>
    <br>
    <a href="view_patients.php">🔙 Back to Patients</a>
</body>
</html>
