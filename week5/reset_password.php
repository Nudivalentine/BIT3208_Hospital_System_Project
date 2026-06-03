<?php
include "config.php";

if (!isset($_GET['token'])) {
    die("Invalid access");
}

$token = $_GET['token'];

$result = $conn->query("SELECT * FROM users WHERE reset_token='$token'");

if ($result->num_rows == 0) {
    die("Invalid or expired token");
}

if (isset($_POST['update'])) {
    $newPass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("UPDATE users 
    SET password='$newPass', reset_token=NULL, token_expiry=NULL
    WHERE reset_token='$token'");

    echo "<script>alert('Password updated successfully'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">
    <h2>Reset Password</h2>

    <form method="POST">
        <input type="password" id="password" name="password"
        placeholder="New Password" onkeyup="checkStrength()" required>

        <p id="strength"></p>

        <button type="submit" name="update">Update Password</button>
    </form>
</div>

<script>
function checkStrength() {
    let pass = document.getElementById("password").value;
    let strength = document.getElementById("strength");

    if (pass.length < 4) {
        strength.innerHTML = "Weak";
        strength.style.color = "red";
    } 
    else if (pass.length < 8) {
        strength.innerHTML = "Medium";
        strength.style.color = "orange";
    } 
    else {
        strength.innerHTML = "Strong";
        strength.style.color = "green";
    }
}
</script>

</body>
</html>