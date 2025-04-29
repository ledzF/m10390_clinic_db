<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../db.php'; // Include the database connection

// Get the patient ID from the URL
$patient_id = $_GET['id'];

// Fetch patient details
$query = "SELECT * FROM patients WHERE id = '$patient_id'";
$patient_result = mysqli_query($conn, $query);
$patient = mysqli_fetch_assoc($patient_result);

// Fetch patient's appointments
$appointments_query = "SELECT * FROM appointments WHERE patient_id = '$patient_id'";
$appointments_result = mysqli_query($conn, $appointments_query);

// Fetch patient's medicines
$medicines_query = "SELECT * FROM medicines WHERE patient_id = '$patient_id'";
$medicines_result = mysqli_query($conn, $medicines_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Details - Random Clinic</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .details-container {
            max-width: 900px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2, h3 {
            color: #373b94;
        }
        p {
            margin: 6px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        a {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #373b94;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        a:hover {
            background-color: #2e337f;
        }
    </style>
</head>
<body>

<div class="details-container">
    <h2>Patient Details: <?php echo htmlspecialchars($patient['name']); ?></h2>

    <!-- Patient Personal Information -->
    <h3>Personal Information</h3>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($patient['name']); ?></p>
    <p><strong>Age:</strong> <?php echo htmlspecialchars($patient['age']); ?></p>
    <p><strong>Gender:</strong> <?php echo htmlspecialchars($patient['gender']); ?></p>
    <p><strong>Contact:</strong> <?php echo htmlspecialchars($patient['contact']); ?></p>

    <!-- Patient Appointments -->
    <h3>Appointments</h3>
    <?php if (mysqli_num_rows($appointments_result) > 0): ?>
    <table>
        <tr>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
        </tr>
        <?php while ($appointment = mysqli_fetch_assoc($appointments_result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
            <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>

<!--    
    <h3>Medicines Assigned</h3>
    <?php if (mysqli_num_rows($medicines_result) > 0): ?>
    <table>
        <tr>
            <th>Medicine Name</th>
            <th>Problem/Diagnosis</th>
        </tr>
        <?php while ($medicine = mysqli_fetch_assoc($medicines_result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($medicine['medicine_name']); ?></td>
            <td><?php echo htmlspecialchars($medicine['problem']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>No medicines assigned.</p>
    <?php endif; ?>    -->

    <a href="../admin_dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>
