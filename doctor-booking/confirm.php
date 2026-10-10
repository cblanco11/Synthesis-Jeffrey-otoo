<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include "doctors.php";

$user = $_SESSION['user'];
$doctor = $_POST['doctor'];
$time = $_POST['time'];

// check that the doctor and time are real
if (!isset($doctors[$doctor]) || !in_array($time, $doctors[$doctor])) {
    echo "Invalid booking. <a href='book.php'>Go back</a>";
    exit();
}

// save the booking to a text file
$booking = $user . "|" . $doctor . "|" . $time . "\n";
file_put_contents("bookings.txt", $booking, FILE_APPEND);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmed</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
    <h1>Booking Confirmed!</h1>
    <p class="success">
        Thank you <b><?php echo $user; ?></b>.<br>
        Your appointment with <b><?php echo $doctor; ?></b> is booked for <b><?php echo $time; ?></b>.
    </p>

    <p><a href="book.php">Book another appointment</a> | <a href="logout.php">Logout</a></p>
</div>

</body>
</html>
