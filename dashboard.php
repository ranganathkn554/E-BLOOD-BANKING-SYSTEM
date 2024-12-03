<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: html2.html");
    exit;
}

$user = $_SESSION['user'];  // Get the logged-in user data
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank - Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f7f7f7;
        }
        .user-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .blood-groups ul {
            list-style-type: none;
        }
        .blood-groups li {
            display: inline-block;
            margin: 10px;
        }
        .blood-groups a {
            text-decoration: none;
            padding: 10px;
            background-color: #cc0000;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .blood-groups a:hover {
            background-color: #ff3333;
        }
        button[type="submit"] {
            background-color: #cc0000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #ff3333;
        }
    </style>
</head>
<body>
    <div class="user-info">
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
        <p><strong>Contact:</strong> <?php echo htmlspecialchars($user['contact']); ?></p>
        <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($user['blood_group']); ?></p>
        <p><strong>Donation Eligibility:</strong> 
            <?php echo $user['donation_eligible'] ? "Eligible" : "Not Eligible"; ?>
        </p>
    </div>

    <hr>

    <div class="blood-groups">
        <h2>Blood Groups</h2>
        <ul>
            <li><a href="fetch_blood_group.php?blood_group=A+">A+</a></li>
            <li><a href="fetch_blood_group.php?blood_group=A-">A-</a></li>
            <li><a href="fetch_blood_group.php?blood_group=B+">B+</a></li>
            <li><a href="fetch_blood_group.php?blood_group=B-">B-</a></li>
            <li><a href="fetch_blood_group.php?blood_group=O+">O+</a></li>
            <li><a href="fetch_blood_group.php?blood_group=O-">O-</a></li>
            <li><a href="fetch_blood_group.php?blood_group=AB+">AB+</a></li>
            <li><a href="fetch_blood_group.php?blood_group=AB-">AB-</a></li>
        </ul>
    </div>

    <form action="logout.php" method="POST" onsubmit="return confirm('Are you sure you want to logout?');">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
