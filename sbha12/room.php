<?php
require_once 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$room_id = $_GET['id'];

$sql = "SELECT * FROM rooms WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();
$room = $result->fetch_assoc();

$sql = "SELECT * FROM words WHERE room_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();
$words = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $room['name']; ?></title>
</head>
<body>
    <h1><?php echo $room['name']; ?></h1>
    <div>
    <?php foreach ($words as $word): ?>
        <div class="word-box">
            <span class="word"><?php echo $word['word']; ?></span>
        </div>
    <?php endforeach; ?>
    </div>
</body>
</html>