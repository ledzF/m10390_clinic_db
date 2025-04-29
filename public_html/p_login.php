<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // IN patients table where name = username and contact = password with LIMIT 1
    $query = "SELECT * FROM patients WHERE name = '$username' AND contact = '$password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($patient = mysqli_fetch_assoc($result)) {
        $patient['role'] = 'patient';
        $_SESSION['user'] = $patient;
        header("Location: patient_dashboard.php");
        exit;
    } else {
        $error = "Invalid name or contact number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Login - Random Clinic</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #373b94;
            margin-bottom: 25px;
        }
        input, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #373b94;
            color: white;
            border: none;
            font-weight: bold;
        }
        button:hover {
            background-color: #2e337f;
        }
        .error-msg {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
        a {
            display: block;
            text-align: center;
            color: #373b94;
            text-decoration: none;
            margin-top: 15px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Patient Login</h2>
    <?php if (isset($error)) echo "<p class='error-msg'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Enter your name" required>
        <input type="password" name="password" placeholder="Enter your contact (as password)" required>
        <button type="submit">Login</button>
      <p style="text-align:center; margin-top:10px;"> Looking For Appointment? <a href="register_patient.php">Book Now</a>
        
    </form>
</div>

</body>
</html>
