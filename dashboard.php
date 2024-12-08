<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: html2.html");
    exit;
}

$user = $_SESSION['user'];  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank - Dashboard</title>
    <style>
       
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

       
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        
        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            font-size: 2em;
            color: #cc0000;
        }

       
        .user-info {
            margin-bottom: 30px;
        }

        .user-info h1 {
            font-size: 1.8em;
            color: #444;
        }

        .user-info p {
            margin: 5px 0;
            font-size: 1em;
        }

        .user-info strong {
            color: #cc0000;
        }

        
        .blood-groups {
            margin-top: 20px;
        }

        .blood-groups h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #444;
        }

        .blood-groups ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .blood-groups li {
            display: inline-block;
        }

        .blood-groups a {
    text-decoration: none;
    display: inline-block;
    padding: 15px 25px;
    background: linear-gradient(135deg, #cc0000, #ff3333);
    color: #fff;
    border-radius: 30px;
    font-size: 1.2em;
    font-weight: bold;
    letter-spacing: 1px;
    text-align: center;
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    transition: transform 0.4s ease, box-shadow 0.4s ease, background 0.4s ease;
    cursor: pointer;
}

.blood-groups a:hover {
    background: linear-gradient(135deg, #ff6666, #ff9999);
    transform: scale(1.15) rotate(-1deg);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
}

.blood-groups a:active {
    transform: scale(1.1) rotate(0deg);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    background: linear-gradient(135deg, #b30000, #e60000);
}


        
        .logout-form {
            text-align: center;
            margin-top: 30px;
        }

        button[type="submit"] {
            background-color: #cc0000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button[type="submit"]:hover {
            background-color: #ff3333;
            transform: scale(1.05);
        }

        
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            header h1 {
                font-size: 1.5em;
            }

            .user-info h1 {
                font-size: 1.5em;
            }

            .blood-groups ul {
                flex-direction: column;
                gap: 5px;
            }

            .blood-groups a {
                font-size: 0.9em;
            }

            button[type="submit"] {
                font-size: 0.9em;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Blood Bank Dashboard</h1>
        </header>

        <div class="user-info">
            <h1>Welcome, <?php echo isset($user['name']) ? htmlspecialchars($user['name']) : "Guest"; ?>!</h1>
            <p><strong>Age:</strong> <?php echo isset($user['age']) ? htmlspecialchars($user['age']) : "N/A"; ?></p>
            <p><strong>Contact:</strong> <?php echo isset($user['contact']) ? htmlspecialchars($user['contact']) : "N/A"; ?></p>
            <p><strong>Blood Group:</strong> <?php echo isset($user['blood_group']) ? htmlspecialchars($user['blood_group']) : "N/A"; ?></p>
        </div>

        <hr>

        <div class="blood-groups">
            <h2>Blood Groups</h2>
            <ul>
                <li><a href="fetch_blood_group.php?blood_group=A%2B">A+</a></li>
                <li><a href="fetch_blood_group.php?blood_group=B%2B">B+</a></li>
                <li><a href="fetch_blood_group.php?blood_group=AB%2B">AB+</a></li>
                <li><a href="fetch_blood_group.php?blood_group=O%2B">O+</a></li>
                <li><a href="fetch_blood_group.php?blood_group=A-">A-</a></li>
                <li><a href="fetch_blood_group.php?blood_group=B-">B-</a></li>
                <li><a href="fetch_blood_group.php?blood_group=O-">O-</a></li>
                <li><a href="fetch_blood_group.php?blood_group=AB-">AB-</a></li>
            </ul>
        </div>

        <form action="logout.php" method="POST" class="logout-form" onsubmit="return confirm('Are you sure you want to logout?');">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
