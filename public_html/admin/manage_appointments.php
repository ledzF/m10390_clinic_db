<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include '../db.php'; // Include the database connection

// Handle scheduling a new appointment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['schedule_appointment'])) {
    $patient_id = $_POST['patient_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $query = "INSERT INTO appointments (patient_id, appointment_date, appointment_time) VALUES ('$patient_id', '$appointment_date', '$appointment_time')";
    if (mysqli_query($conn, $query)) {
        $message = "Appointment scheduled successfully.";
    } else {
        $message = "Error scheduling appointment: " . mysqli_error($conn);
    }
}

// Fetch all patients to schedule appointments for
$query = "SELECT * FROM patients";
$patients = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="dashboard-container">
    <h2>Manage Appointments</h2>
    
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    
    <!-- Schedule appointment form -->
    <h3>Schedule New Appointment</h3>
    <form method="POST">
        <select name="patient_id" required>
            <option value="">Select Patient</option>
            <?php while ($patient = mysqli_fetch_assoc($patients)): ?>
            <option value="<?php echo $patient['id']; ?>"><?php echo $patient['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <input type="date" name="appointment_date" required>
        <input type="time" name="appointment_time" required>
        <button type="submit" name="schedule_appointment">Schedule Appointment</button>
    </form>
</div>

</body>
</html>
