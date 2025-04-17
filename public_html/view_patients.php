<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Patients</title>
</head>
<body>
    <h2>📋 Patient List</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['age'] ?></td>
            <td><?= $row['gender'] ?></td>
            <td><?= $row['contact'] ?></td>
            <td>
                <a href="edit_patient.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
                <a href="delete_patient.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?');">🗑 Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="add_patient.php">➕ Add New Patient</a><br><br>
    <a href="dashboard.php">🔙 Back to Dashboard</a>
</body>
</html>
