<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}

$requested_blood_group = isset($_GET['blood_group']) ? str_replace(' ', '+', trim($_GET['blood_group'])) : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 2rem auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
        }

        h1, h2 {
            text-align: center;
            color: #d32f2f;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background: #f7f7f7;
            margin: 1rem 0;
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        li strong {
            color: #555;
        }

        .no-data {
            text-align: center;
            color: #999;
        }

        footer {
            text-align: center;
            margin-top: 2rem;
            padding: 1rem;
            background: #333;
            color: #fff;
            border-radius: 0 0 8px 8px;
        }

        footer a {
            color: #f1c40f;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .go-back {
            display: block;
            width: 150px;
            margin: 2rem auto;
            text-align: center;
            padding: 10px 20px;
            background: #d32f2f;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .go-back:hover {
            background: #b71c1c;
        }

    </style>
</head>
<body>
    <div class="container">
        <?php if ($requested_blood_group): ?>
            <?php
            $sql = "SELECT name, age, contact, donation_eligible FROM users WHERE blood_group = ?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $requested_blood_group);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    mysqli_stmt_bind_result($stmt, $name, $age, $contact, $donation_eligible);
                    echo "<h2>Donors with Blood Group " . htmlspecialchars($requested_blood_group) . ":</h2>";
                    echo "<ul>";
                    while (mysqli_stmt_fetch($stmt)) {
                        echo "<li>";
                        echo "<strong>Name:</strong> " . htmlspecialchars($name) . "<br>";
                        echo "<strong>Age:</strong> " . htmlspecialchars($age) . "<br>";
                        echo "<strong>Contact:</strong> " . htmlspecialchars($contact) . "<br>";
                        echo "<strong>ARE YOU READY TO DONATE YOUR BLOOD:</strong> " . ($donation_eligible === "Yes" || $donation_eligible == 1 ? "YES" : "NO") . "<br>";
                        echo "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p class='no-data'>No donors found with blood group " . htmlspecialchars($requested_blood_group) . ".</p>";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "<p class='no-data'>An error occurred. Please try again later.</p>";
            }
            ?>
        <?php else: ?>
            <p class="no-data">Invalid blood group requested.</p>
        <?php endif; ?>

        <a href="dashboard.php" class="go-back">Go Back</a>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Blood Bank System | <a href="dd.html">Contact Us</a></p>
    </footer>
</body>
</html>

<?php mysqli_close($conn); ?>
