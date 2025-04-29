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
    <style>
        body { 
            font-family: Arial; 
            background: url('assets/bg3.jpg') no-repeat center center fixed; 
            background-size: cover;
            padding: 20px; 
            color: #333f; /* Optional: Adjust text color to ensure readability */
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            background: #fff; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }
        th, td { 
            padding: 12px; 
            border: 1px solid #ddd; 
            text-align: left; 
        }
        th { 
            background-color: #373b94; 
            color: white; 
        }
        a { 
            color: #373b94; 
            text-decoration: none; 
            font-weight: bold; 
        }
        a:hover { 
            text-decoration: underline; 
        }
    </style>
</head>
<body>
    <h2>📃</h2>
    <table>
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
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['age']) ?></td>
            <td><?= htmlspecialchars($row['gender']) ?></td>
            <td><?= htmlspecialchars($row['contact']) ?></td>
            <td>
                <a href="edit_patient.php?id=<?= $row['id'] ?>">Edit</a> /
                <a href="delete_patient.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
  <!--  <a href="register_patient.php">New Appointment?</a><br><br> 
    <a href="dashboard.php">Back to Dashboard</a> -->
</body>
</html>
