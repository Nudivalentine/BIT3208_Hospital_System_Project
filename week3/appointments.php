<?php
session_start();
include "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">Appointments Module</div>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="patients.php">Patients</a>
    <a href="appointments.php">Appointments</a>
    <a href="reports.php">Reports</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">

<h2>Create Appointment</h2>

<form method="POST">
    <input type="text" name="patient_name" placeholder="Patient Name">
    <input type="text" name="doctor_name" placeholder="Doctor Name">
    <input type="date" name="appointment_date">
    <input type="text" name="status" placeholder="Status">
    <button type="submit" name="save">Save</button>
</form>

<?php
if (isset($_POST['save'])) {
    $p = $_POST['patient_name'];
    $d = $_POST['doctor_name'];
    $date = $_POST['appointment_date'];
    $s = $_POST['status'];

    $conn->query("INSERT INTO appointments(patient_name,doctor_name,appointment_date,status)
    VALUES('$p','$d','$date','$s')");
}
?>

<h2>Appointments List</h2>

<?php
$res = $conn->query("SELECT * FROM appointments");
while ($r = $res->fetch_assoc()) {
    echo "<p>{$r['patient_name']} - {$r['doctor_name']} - {$r['appointment_date']} - {$r['status']}</p>";
}
?>

</div>
</body>
</html>