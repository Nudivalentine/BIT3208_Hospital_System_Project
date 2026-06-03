<?php
session_start();
include "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">Reports Module</div>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="patients.php">Patients</a>
    <a href="appointments.php">Appointments</a>
    <a href="reports.php">Reports</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">

<h2>Add Report</h2>

<form method="POST">
    <input type="text" name="title" placeholder="Report Title">
    <input type="text" name="patient" placeholder="Patient Name">
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit" name="save">Save</button>
</form>

<?php
if (isset($_POST['save'])) {
    $t = $_POST['title'];
    $p = $_POST['patient'];
    $d = $_POST['description'];

    $conn->query("INSERT INTO reports(report_title,patient_name,description)
    VALUES('$t','$p','$d')");
}
?>

<h2>Reports List</h2>

<?php
$res = $conn->query("SELECT * FROM reports");
while ($r = $res->fetch_assoc()) {
    echo "<p>{$r['report_title']} - {$r['patient_name']}</p>";
}
?>

</div>

</body>
</html>