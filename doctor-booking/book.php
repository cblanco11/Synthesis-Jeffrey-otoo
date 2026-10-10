<?php
session_start();

// only logged in users can see this page
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include "doctors.php";

// remove times that are already booked
if (file_exists("bookings.txt")) {
    $lines = file("bookings.txt");
    foreach ($lines as $line) {
        $parts = explode("|", trim($line));   // user|doctor|time
        $doc = $parts[1];
        $time = $parts[2];

        if (isset($doctors[$doc])) {
            $index = array_search($time, $doctors[$doc]);
            if ($index !== false) {
                unset($doctors[$doc][$index]);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
    <p class="top">Logged in as <b><?php echo $_SESSION['user']; ?></b> | <a href="logout.php">Logout</a></p>

    <h1>Book an Appointment</h1>

    <form action="confirm.php" method="POST" onsubmit="return checkBooking()">
        <label for="doctor">Choose a doctor</label>
        <select id="doctor" name="doctor" onchange="showTimes()">
            <option value="">-- select doctor --</option>
            <?php
            foreach ($doctors as $name => $times) {
                echo "<option value='$name'>$name</option>";
            }
            ?>
        </select>

        <label for="time">Choose a time</label>
        <select id="time" name="time">
            <option value="">-- select a doctor first --</option>
        </select>

        <button type="submit">Book Appointment</button>
    </form>
</div>

<script>
    // pass the doctors and their free times from PHP to JavaScript
    var doctors = <?php echo json_encode(array_map('array_values', $doctors)); ?>;
</script>
<script src="script.js"></script>
</body>
</html>
