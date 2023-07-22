<?php
session_start();
require_once 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT id, name, password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['password'] == $password) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        header("Location: index.php");
        exit;
    }
}

header("Location: login.php?error=1");
exit;
?>