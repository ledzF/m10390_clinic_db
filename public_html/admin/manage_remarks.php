<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Handle saving a remark
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_remark'])) {
    $patient_id = $_POST['patient_id'];
    $remark = mysqli_real_escape_string($conn, $_POST['remark']);

    $update_query = "UPDATE patients SET remarks = '$remark' WHERE id = $patient_id";
    mysqli_query($conn, $update_query);
}

$patients = mysqli_query($conn, "SELECT id, name, remarks FROM patients");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Patient Remarks</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .remarks-container {
            max-width: 900px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #373b94;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: top;
        }
        textarea {
            width: 100%;
            height: 70px;
            resize: vertical;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            padding: 8px 16px;
            background-color: #373b94;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2e337f;
        }
    </style>
</head>
<body>

<div class="remarks-container">
    <h2>Manage Patient Remarks</h2>

    <table>
        <tr>
            <th>Patient Name</th>
            <th>Remarks</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($patients)): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="patient_id" value="<?= $row['id'] ?>">
                    <textarea name="remark"><?= htmlspecialchars($row['remarks']) ?></textarea>
            </td>
            <td>
                    <button type="submit" name="save_remark">Save</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
