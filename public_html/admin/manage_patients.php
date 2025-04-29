<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include '../db.php'; // Include the database connection

// Handle adding a new patient
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_patient'])) {
    $name = $_POST['name'];
    $user_id = $_POST['user_id'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];

    $query = "INSERT INTO patients (name, user_id, age, gender, contact) VALUES ('$name', '$user_id', '$age', '$gender', '$contact')";
    if (mysqli_query($conn, $query)) {
        $message = "Patient added successfully.";
    } else {
        $message = "Error adding patient: " . mysqli_error($conn);
    }
}

// Fetch all patients
$query = "SELECT * FROM patients";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Patients</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="dashboard-container">
    <h2>Manage Patients</h2>
    
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    
    <!-- Add patient form -->
    <h3>Add New Patient</h3>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
      <input type="text" name="user_id" placeholder="user_id" required>
        <input type="number" name="age" placeholder="Age" required>
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <input type="text" name="contact" placeholder="Contact" required>
        <button type="submit" name="add_patient">Add Patient</button>
    </form>

    <h3>All Patients</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>user_id</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>

        <?php while ($patient = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $patient['id']; ?></td>
            <td><?php echo $patient['user_id']; ?></td>
            <td><?php echo $patient['name']; ?></td>
            <td><?php echo $patient['age']; ?></td>
            <td><?php echo $patient['gender']; ?></td>
            <td><?php echo $patient['contact']; ?></td>
            <td>
                <!-- Edit and delete buttons -->
                <a href="../edit_patient.php?id=<?php echo $patient['id']; ?>">Edit</a> |
                <a href="../delete_patient.php?id=<?php echo $patient['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>