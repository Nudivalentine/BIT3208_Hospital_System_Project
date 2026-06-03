<?php
session_start();
include "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

// DELETE REPORT
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM reports WHERE id=$id");
    header("Location: reports.php");
    exit();
}

// FETCH REPORT FOR EDIT
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM reports WHERE id=$id");
    $editData = $result->fetch_assoc();
}

// UPDATE REPORT
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $patient = $_POST['patient'];
    $description = $_POST['description'];

    $conn->query("UPDATE reports SET 
        report_title='$title',
        patient_name='$patient',
        description='$description'
        WHERE id=$id");

    header("Location: reports.php");
    exit();
}

// CREATE REPORT
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $patient = $_POST['patient'];
    $description = $_POST['description'];

    $conn->query("INSERT INTO reports(report_title,patient_name,description)
    VALUES('$title','$patient','$description')");
}
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

<h2><?php echo $editData ? "Edit Report" : "Add Report"; ?></h2>

<form method="POST">

    <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">

    <input type="text" name="title" placeholder="Report Title"
    value="<?php echo $editData['report_title'] ?? ''; ?>" required>

    <input type="text" name="patient" placeholder="Patient Name"
    value="<?php echo $editData['patient_name'] ?? ''; ?>" required>

    <textarea name="description" placeholder="Description" required><?php echo $editData['description'] ?? ''; ?></textarea>

    <?php if ($editData): ?>
        <button type="submit" name="update">Update Report</button>
    <?php else: ?>
        <button type="submit" name="save">Save Report</button>
    <?php endif; ?>

</form>

<h2>Reports List</h2>

<table border="1" cellpadding="10" width="100%">
    <tr>
        <th>Title</th>
        <th>Patient</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>

<?php
$res = $conn->query("SELECT * FROM reports ORDER BY id DESC");

while ($r = $res->fetch_assoc()) {
    echo "
    <tr>
        <td>{$r['report_title']}</td>
        <td>{$r['patient_name']}</td>
        <td>{$r['description']}</td>
        <td>
            <a href='reports.php?edit={$r['id']}'>Edit</a> |
            <a href='reports.php?delete={$r['id']}' onclick=\"return confirm('Delete this report?')\">Delete</a>
        </td>
    </tr>
    ";
}
?>

</table>

</div>

</body>
</html>