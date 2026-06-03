<?php
include "config.php";

if (isset($_POST['reset'])) {
    $username = $_POST['username'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");

    if ($result->num_rows > 0) {
        $token = md5(time());
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $conn->query("UPDATE users 
        SET reset_token='$token', token_expiry='$expiry'
        WHERE username='$username'");

        echo "<h3>Simulated Email:</h3>";
        echo "<p>Click link to reset password:</p>";
        echo "<a href='reset_password.php?token=$token'>Reset Password</a>";
    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">
    <h2>Forgot Password</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <button type="submit" name="reset">Send Reset Link</button>
    </form>
</div>

</body>
</html>