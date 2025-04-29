<?php
session_start();

// Check if patient is logged in
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'patient') {
    header("Location: login.php");
    exit;
}

include 'db.php';

$patient = $_SESSION['user'];

// Fetch appointments
$appointments_query = "SELECT * FROM appointments WHERE patient_id = " . $patient['id'];
$appointments_result = mysqli_query($conn, $appointments_query);

// updated remarks from database
$patient_query = "SELECT remarks FROM patients WHERE id = " . $patient['id'];
$patient_result = mysqli_query($conn, $patient_query);
$patient_info = mysqli_fetch_assoc($patient_result);
$remarks = $patient_info['remarks'] ?? 'No remarks available.';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard - Random Clinic</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 30px;
        }
        .dashboard {
            background: #fff;
            max-width: 900px;
            margin: auto;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2, h3 {
            color: #373b94;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #fdfdfd;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .remarks-box {
            background: #fff9d6;
            padding: 15px;
            border: 1px solid #ffe58f;
            border-radius: 6px;
            margin-top: 20px;
            white-space: pre-wrap;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        a {
            display: inline-block;
            margin-top: 30px;
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

<div class="dashboard">
    <h2>Welcome, <?= htmlspecialchars($patient['name']) ?></h2>

    <h3>Your Appointments</h3>
    <?php if (mysqli_num_rows($appointments_result) > 0): ?>
        <table>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
            <?php while ($appt = mysqli_fetch_assoc($appointments_result)): ?>
            <tr>
                <td><?= htmlspecialchars($appt['appointment_date']) ?></td>
                <td><?= htmlspecialchars($appt['appointment_time']) ?></td>
                <td><?= htmlspecialchars($appt['status']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>

    <h3>Doctor's Remarks</h3>
    <div class="remarks-box">
        <?= nl2br(htmlspecialchars($remarks)) ?>
    </div>

    <a href="logout.php">← Logout</a>
</div>

</body>
</html>
