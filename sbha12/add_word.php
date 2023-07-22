<?php

require_once 'db.php';

$word_box_name = $_POST['word_box_name'];
$word = $_POST['word'];
$click_limit = $_POST['click_limit'];
$word_box_size = $_POST['word_box_size'];
$word_size = $_POST['word_size'];

$stmt = $conn->prepare("INSERT INTO words (word_box_name, word, click_limit, word_box_size, word_size) VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("ssiii", $word_box_name, $word, $click_limit, $word_box_size, $word_size);

$stmt->execute();

header("Location: admin.php");

exit();

?>