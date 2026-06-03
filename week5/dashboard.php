<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    Welcome, <?php echo $_SESSION['user']; ?> | Hospital Dashboard
</div>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="patients.php">Patients</a>
    <a href="appointments.php">Appointments</a>
    <a href="reports.php">Reports</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>Dashboard Overview</h2>

    <div style="display:flex; gap:10px; flex-wrap:wrap;">

    <a href="patients.php" style="text-decoration:none;">
        <div class="module-card" style="background:yellow;">
            Patients Module
        </div>
    </a>

    <a href="appointments.php" style="text-decoration:none;">
        <div class="module-card" style="background:lightgreen;">
            Appointments Module
        </div>
    </a>

    <a href="reports.php" style="text-decoration:none;">
        <div class="module-card" style="background:white; border:1px solid #ccc;">
            Reports Module
        </div>
    </a>

</div>
</div>

</body>
</html>