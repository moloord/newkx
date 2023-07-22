
<?php

session_start();

require_once 'db.php';

if (isset($_GET['time']) && isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

    $time_spent = $_GET['time'];



    $sql = "INSERT INTO user_time (user_id, time_spent, session_date) VALUES (?, ?, CURDATE())

            ON DUPLICATE KEY UPDATE time_spent = time_spent + ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("iii", $user_id, $time_spent, $time_spent);

    $stmt->execute();

}

?>
