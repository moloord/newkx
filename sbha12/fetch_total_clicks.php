<?php
require_once 'db.php';

if (isset($_GET['word_id'])) {
    $word_id = $_GET['word_id'];

    $sql = "SELECT clicks FROM visitor_clicks WHERE word_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $word_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $clicks = $row['clicks'];

    echo $clicks;
}
?>