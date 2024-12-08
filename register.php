<?php
session_start(); 

include 'db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $age = (int) $_POST['age'];
    $blood_group = htmlspecialchars(trim($_POST['blood_group']));
    $donate_agreement = htmlspecialchars(trim($_POST['donate_agreement']));
    $contact = trim($_POST['contact']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if ($age < 18) {
        echo "You must be 18 or older to register.";
        exit;
    }

    if (!preg_match('/^[A-Za-z\s]+$/', $name)) {
        echo "Name should only contain letters and spaces.";
        exit;
    }

    if (!preg_match('/^(A|B|AB|O)[+-]$/', $blood_group)) {
        echo "Invalid blood group.";
        exit;
    }

    if (!in_array($donate_agreement, ['Yes', 'No'], true)) {
        echo "Invalid donation agreement choice.";
        exit;
    }

    if (!preg_match('/^\d{10}$/', $contact)) {
        echo "Contact number must be exactly 10 digits.";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO users (name, age, blood_group, donation_eligible, contact, password) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sissss", $name, $age, $blood_group, $donate_agreement, $contact, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
          
            $_SESSION['user'] = [
                'name' => $name,
                'age' => $age,
                'blood_group' => $blood_group,
                'contact' => $contact,
                'donation_eligible' => $donation_eligible,
            ];

            
            header("Location: /pv5/dashboard.php");
            exit;
        } else {
            error_log("Database error: " . mysqli_stmt_error($stmt)); // Log the error
            echo "An error occurred. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    } else {
        error_log("Failed to prepare the statement: " . mysqli_error($conn));
        echo "An error occurred. Please try again later.";
    }

    mysqli_close($conn); 
}
?>
