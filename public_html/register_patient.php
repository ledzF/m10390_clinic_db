<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $age     = $_POST['age'];
    $gender  = $_POST['gender'];
    $contact = $_POST['contact'];
    $code    = $_POST['reg_code'];

    // Permanent code for legit registration
    $valid_code = "5743";

    if ($code !== $valid_code) {
        $error = "Invalid registration code.";
    } else {
        $query = "INSERT INTO patients (name, age, gender, contact)
                  VALUES ('$name', '$age', '$gender', '$contact')";

        if (mysqli_query($conn, $query)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Error occurred while adding patient.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Patient</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-box h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-box input,
        .form-box select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .form-box button {
            width: 100%;
            padding: 10px;
            background-color: #373b94;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            margin-top: 10px;
        }

        .error-msg {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="form-wrapper">
    <div class="form-box">
        <h2>Register Patient</h2>
        <?php if (isset($error)) echo "<p class='error-msg'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="number" name="age" placeholder="Age" required>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
            <input type="text" name="contact" placeholder="Contact Number" required>
            <input type="text" name="reg_code" placeholder="Enter Registration Code" required>
            <button type="submit">Add Patient</button>
        </form>
    </div>
</div>

</body>
</html>
