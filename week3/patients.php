<?php
session_start();
include "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    Patients Module
</div>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="patients.php">Patients</a>
    <a href="appointments.php">Appointments</a>
    <a href="reports.php">Reports</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>Add Patient</h2>

    <form method="POST">
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="text" name="gender" placeholder="Gender" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <button type="submit" name="save">Save Patient</button>
    </form>

<?php
if (isset($_POST['save'])) {
    $name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    $conn->query("INSERT INTO patients(full_name,age,gender,phone)
    VALUES('$name','$age','$gender','$phone')");
}
?>

    <h2>All Patients</h2>

    <?php
    $result = $conn->query("SELECT * FROM patients");
    while ($row = $result->fetch_assoc()) {
        echo "<p>".$row['full_name']." | ".$row['age']." | ".$row['gender']." | ".$row['phone']."</p>";
    }
    ?>
</div>

</body>
</html>