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
    <a href="#">Patients</a>
    <a href="#">Appointments</a>
    <a href="#">Reports</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>Dashboard Overview</h2>

    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <div style="background:yellow; padding:20px;">Patients Module</div>
        <div style="background:lightgreen; padding:20px;">Appointments Module</div>
        <div style="background:white; border:1px solid #ccc; padding:20px;">Reports Module</div>
    </div>
</div>

</body>
</html>