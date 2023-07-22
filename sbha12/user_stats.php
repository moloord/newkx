<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch total clicks and today's clicks
$sql = "SELECT SUM(clicks) AS total_clicks,
               SUM(CASE WHEN DATE(timestamp) = CURDATE() THEN clicks ELSE 0 END) AS today_clicks
        FROM user_clicks
        WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$clicks_data = $result->fetch_assoc();

// Fetch total time on site
$sql = "SELECT SUM(time_spent) AS total_time FROM user_time WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$time_data = $result->fetch_assoc();

// Fetch individual word clicks
$sql = "SELECT w.word, uc.clicks
        FROM user_clicks uc
        JOIN words w ON w.id = uc.word_id
        WHERE uc.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$word_clicks_data = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Stats</title>
    <link rel="stylesheet" href="user_stats_style.css">
</head>
<body>
    <header>
        <h1>User Statistics</h1>
    </header>
   <div class="stats-container">
    <div class="top-stats">
      <div class="stat-box total-clicks-animated animate__infinite">
        <span>Total Clicks:</span> <?php echo $clicks_data['total_clicks']; ?>
      </div>
      <div class="stat-box total-time-on-site">
        <span>Total Time on Site:</span> <?php echo $time_data['total_time']; ?> seconds
      </div>
      <div class="stat-box">
        <span>Today's Clicks:</span> <?php echo $clicks_data['today_clicks']; ?>
      </div>
        </div>
        <div class="stat-box">
            <span>Word Clicks:</span>
            <ul>
            <?php foreach ($word_clicks_data as $data): ?>
                <li><?php echo $data['word']; ?>: <?php echo $data['clicks']; ?> clicks</li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>