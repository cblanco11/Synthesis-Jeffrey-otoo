<?php
session_start();

// if already logged in, go straight to booking page
if (isset($_SESSION['user'])) {
    header("Location: book.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Doctor Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
    <h1>Doctor Appointment Booking</h1>
    <h2>Login</h2>

    <?php
    if (isset($_GET['error'])) {
        echo "<p class='error'>Wrong username or password</p>";
    }
    ?>

    <form action="login.php" method="POST" onsubmit="return checkLogin()">
        <label for="username">Username</label>
        <input type="text" id="username" name="username">

        <label for="password">Password</label>
        <input type="password" id="password" name="password">

        <button type="submit">Login</button>
    </form>

    <p class="hint">Test account: jeff / 1234</p>
</div>

<script src="script.js"></script>
</body>
</html>
