<?php
include "config.php";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE username='$username'");

    if ($check->num_rows > 0) {
        echo "<script>alert('Username already exists');</script>";
    } else {
        $conn->query("INSERT INTO users (username, password)
        VALUES ('$username', '$password')");

        echo "<script>alert('Registration successful! You can now login');</script>";
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">
    <h2>User Registration</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>

        <input type="password" id="password" name="password"
        placeholder="Password" onkeyup="checkStrength()" required>

        <p id="strength"></p>

        <button type="submit" name="register">Register</button>
    </form>

    <p>Already have an account? <a href="index.php">Login</a></p>
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