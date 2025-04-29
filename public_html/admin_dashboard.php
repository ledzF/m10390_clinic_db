<?php
session_start();

// check if the user is logged in and is an admin for #SECURITY
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include 'db.php'; // Include the database connection

// Fetch all patients
$query = "SELECT * FROM patients";
$patients = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Random Clinic</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: Arial, sans-serif;
        }
        .dashboard-container {
            width: 100%;
            max-width: 1000px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .dashboard-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .dashboard-container a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: #373b94;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            text-align: center;
        }
        .dashboard-container a:hover {
            background-color: #373b94;
        }
        .logout-btn {
            background-color: #373b94;
        }
        .logout-btn:hover {
            background-color: #373b94;
        }
    </style> 
  </head>
<body>

<div class="dashboard-container">
    <h2>Welcome Admin: <?php echo $_SESSION['user']['username']; ?></h2>
    <p>What would you like to do today?</p>

    <!-- Buttons for different functionalities -->
    <a href="admin/manage_patients.php">Manage Patients</a>
    <a href="admin/manage_appointments.php">Manage Appointments</a>
    <a href="admin/manage_remarks.php">Manage Remarks</a>

    <h3>Patient List</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Details</th>
        </tr>
        <?php while ($patient = mysqli_fetch_assoc($patients)): ?>
        <tr>
            <td><?php echo $patient['id']; ?></td>
            <td><?php echo $patient['name']; ?></td>
            <td><?php echo $patient['age']; ?></td>
            <td><?php echo $patient['gender']; ?></td>
            <td><?php echo $patient['contact']; ?></td>
            <td>
                <a href="admin/view_patient_details.php?id=<?php echo $patient['id']; ?>">View Details</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- 
    <a href="logout.php" class="logout-btn">Logout</a> -->
</div>

</body>
</html>
