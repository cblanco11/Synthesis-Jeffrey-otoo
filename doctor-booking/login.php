<?php
session_start();

// users are hardcoded for now (no database yet)
$users = array(
    "jeff" => "1234",
    "ama"  => "pass123"
);

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($users[$username]) && $users[$username] == $password) {
    $_SESSION['user'] = $username;
    header("Location: book.php");
} else {
    header("Location: index.php?error=1");
}
exit();
?>
