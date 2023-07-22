<?php

require_once 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the email is already registered
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If the email is already registered, redirect back to the registration page with an error message
    header("Location: register.php?error=email_already_registered");
    exit;
}

$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $password);
$stmt->execute();

session_start();
$_SESSION['user_id'] = $conn->insert_id;
$_SESSION['user_name'] = $name;

header("Location: index.php");
exit;

?>