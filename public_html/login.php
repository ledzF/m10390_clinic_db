<?php
session_start(); 
include 'db.php'; // saves us from writing the database again 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // grabbing user details from the form like
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'"; // preparing sql query to find user in users table [if that he actually exists or not]
    $result = mysqli_query($conn, $query); // send query to database to fetch result
    $user = mysqli_fetch_assoc($result); // storing username so we can compare password

    if ($user && $password === $user['password']) {  // if username exists now we will check for password if it matches then
        $_SESSION['user'] = $username; 
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Random Clinic Staff Login</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 80px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .login-container button {
            width: 100%;
            background-color: #373b94;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        }
        .error-msg {
            color: red;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Random Clinic (Emergency 24X7)</h2>
    <?php if (isset($error)) echo "<p class='error-msg'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
      <p style="text-align:center; margin-top:10px;">
    Looking For Appointment? <a href="register_patient.php">Book Now</a>
</p>

    </form>
</div>

</body>
</html>
