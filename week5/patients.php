<?php
session_start();
include "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM patients WHERE id=$id");
    header("Location: patients.php");
}

// FETCH DATA FOR EDIT
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM patients WHERE id=$id");
    $editData = $result->fetch_assoc();
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    $conn->query("UPDATE patients SET 
        full_name='$name',
        age='$age',
        gender='$gender',
        phone='$phone'
        WHERE id=$id");

    header("Location: patients.php");
}

// INSERT
if (isset($_POST['save'])) {
    $name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    $conn->query("INSERT INTO patients(full_name,age,gender,phone)
    VALUES('$name','$age','$gender','$phone')");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">Patients Module</div>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="patients.php">Patients</a>
    <a href="appointments.php">Appointments</a>
    <a href="reports.php">Reports</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">

<h2><?php echo $editData ? "Edit Patient" : "Add Patient"; ?></h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">

    <input type="text" name="full_name" placeholder="Full Name"
    value="<?php echo $editData['full_name'] ?? ''; ?>" required>

    <input type="number" name="age" placeholder="Age"
    value="<?php echo $editData['age'] ?? ''; ?>" required>

    <input type="text" name="gender" placeholder="Gender"
    value="<?php echo $editData['gender'] ?? ''; ?>" required>

    <input type="text" name="phone" placeholder="Phone"
    value="<?php echo $editData['phone'] ?? ''; ?>" required>

    <?php if ($editData): ?>
        <button type="submit" name="update">Update Patient</button>
    <?php else: ?>
        <button type="submit" name="save">Save Patient</button>
    <?php endif; ?>
</form>

<h2>All Patients</h2>

<table border="1" cellpadding="10" width="100%">
<tr>
    <th>Name</th>
    <th>Age</th>
    <th>Gender</th>
    <th>Phone</th>
    <th>Actions</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM patients");

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['full_name']}</td>
        <td>{$row['age']}</td>
        <td>{$row['gender']}</td>
        <td>{$row['phone']}</td>
        <td>
            <a href='patients.php?edit={$row['id']}'>Edit</a> |
            <a href='patients.php?delete={$row['id']}' onclick=\"return confirm('Are you sure?')\">Delete</a>
        </td>
    </tr>";
}
?>

</table>

</div>

</body>
</html>