<?php
session_start();

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact = htmlspecialchars(trim($_POST['contact'])); // Sanitize input
    $password = $_POST['password'];

    
    $sql = "SELECT id, name, age, blood_group, donation_eligible, contact, password FROM users WHERE contact = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $contact); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt); 

        if (mysqli_stmt_num_rows($stmt) > 0) {
            
            mysqli_stmt_bind_result($stmt, $id, $name, $age, $blood_group, $donation_eligible, $user_contact, $user_password);
            mysqli_stmt_fetch($stmt);

            
            if (password_verify($password, $user_password)) {
                
                session_regenerate_id(true);

                
                $_SESSION['user'] = [
                    'id' => $id,
                    'name' => $name,
                    'age' => $age,
                    'blood_group' => $blood_group,
                    'donation_eligible' => (bool)$donation_eligible,
                    'contact' => $user_contact,
                ];

                
                header("Location: dashboard.php");
                exit;
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "No user found with this contact number.";
        }

        mysqli_stmt_close($stmt); 
    } else {
        error_log("Database query preparation failed: " . mysqli_error($conn)); // Log error
        echo "An error occurred. Please try again later.";
    }

    mysqli_close($conn); 
}
?>
