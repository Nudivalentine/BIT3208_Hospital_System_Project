<?php
session_start();
include "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

// DELETE APPOINTMENT
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM appointments WHERE id=$id");
    header("Location: appointments.php");
    exit();
}

// FETCH APPOINTMENT FOR EDITING
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM appointments WHERE id=$id");
    $editData = $result->fetch_assoc();
}

// UPDATE APPOINTMENT
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $patient = $_POST['patient_name'];
    $doctor = $_POST['doctor_name'];
    $date = $_POST['appointment_date'];
    $status = $_POST['status'];

    $conn->query("UPDATE appointments SET
        patient_name='$patient',
        doctor_name='$doctor',
        appointment_date='$date',
        status='$status'
        WHERE id=$id");

    header("Location: appointments.php");
    exit();
}

// CREATE APPOINTMENT
if (isset($_POST['save'])) {
    $patient = $_POST['patient_name'];
    $doctor = $_POST['doctor_name'];
    $date = $_POST['appointment_date'];
    $status = $_POST['status'];

    $conn->query("INSERT INTO appointments
    (patient_name, doctor_name, appointment_date, status)
    VALUES
    ('$patient', '$doctor', '$date', '$status')");
}
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

<h2><?php echo $editData ? "Edit Appointment" : "Create Appointment"; ?></h2>

<form method="POST">

    <input type="hidden" name="id"
           value="<?php echo $editData['id'] ?? ''; ?>">

    <input type="text"
           name="patient_name"
           placeholder="Patient Name"
           value="<?php echo $editData['patient_name'] ?? ''; ?>"
           required>

    <input type="text"
           name="doctor_name"
           placeholder="Doctor Name"
           value="<?php echo $editData['doctor_name'] ?? ''; ?>"
           required>

    <input type="date"
           name="appointment_date"
           value="<?php echo $editData['appointment_date'] ?? ''; ?>"
           required>

    <input type="text"
           name="status"
           placeholder="Status"
           value="<?php echo $editData['status'] ?? ''; ?>"
           required>

    <?php if ($editData): ?>
        <button type="submit" name="update">Update Appointment</button>
    <?php else: ?>
        <button type="submit" name="save">Save Appointment</button>
    <?php endif; ?>

</form>

<h2>Appointments List</h2>

<table border="1" cellpadding="10" width="100%">
    <tr>
        <th>Patient</th>
        <th>Doctor</th>
        <th>Date</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

<?php
$res = $conn->query("SELECT * FROM appointments ORDER BY appointment_date DESC");

while ($r = $res->fetch_assoc()) {
    echo "
    <tr>
        <td>{$r['patient_name']}</td>
        <td>{$r['doctor_name']}</td>
        <td>{$r['appointment_date']}</td>
        <td>{$r['status']}</td>
        <td>
            <a href='appointments.php?edit={$r['id']}'>Edit</a> |
            <a href='appointments.php?delete={$r['id']}'
               onclick=\"return confirm('Are you sure you want to delete this appointment?');\">
               Delete
            </a>
        </td>
    </tr>";
}
?>

</table>

</div>

</body>
</html>