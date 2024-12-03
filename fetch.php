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
        /* Add refined CSS here */
    </style>
</head>
<body>
    <header>
        <h1>Blood Bank Dashboard</h1>
    </header>

    <section class="user-info">
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
        <p><strong>Contact:</strong> <?php echo htmlspecialchars($user['contact']); ?></p>
        <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($user['blood_group']); ?></p>
        <p><strong>Donation Eligibility:</strong> 
            <?php echo $user['donation_eligible'] ? "Eligible" : "Not Eligible"; ?>
        </p>
    </section>

    <hr>

    <section class="blood-groups">
        <h2>Blood Groups</h2>
        <p>Click on a blood group to see the list of registered donors:</p>
        <ul>
            <?php
            $blood_groups = ["A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-"];
            foreach ($blood_groups as $group) {
                echo "<li><a href='fetch_blood_group.php?blood_group=" . urlencode($group) . "'>" . htmlspecialchars($group) . "</a></li>";
            }
            ?>
        </ul>
    </section>

    <form action="logout.php" method="POST" onsubmit="return confirm('Are you sure you want to logout?');">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
