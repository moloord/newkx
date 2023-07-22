<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Box</title>
    <link rel="stylesheet" href="word112-box.css">
    <script src="index_scripts.js"></script>
</head>
<body>
    <header>
        <?php
        session_start();
        if (isset($_SESSION['user_name'])) {
            echo "<span>Hello, {$_SESSION['user_name']}!</span>";
            echo "<a href='logout.php'><button class='logout-btn'>Logout</button></a>";
        } else {
            echo "<a href='register.php'><button class='register-btn'>Register</button></a>";
            echo "<a href='login.php'><button class='login-btn'>Login</button></a>";
        }
        ?>
        <h1><a href="index.php">Back to Words</a></h1>
    </header>
    <div class="word-boxes-container">
        <div class="word-container">
            <?php
            require_once 'db.php';

            if (isset($_GET['word_id'])) {
                $word_id = $_GET['word_id'];
                $stmt = $conn->prepare("SELECT id, word, click_limit, clicks, word_box_size, word_size FROM words WHERE id = ?");
                $stmt->bind_param("i", $word_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($row = $result->fetch_assoc()) {
                    $clickable = $row['clicks'] < $row['click_limit'];
                    $class = $clickable ? "clickable" : "non-clickable";
                    $progress_width = ($row['click_limit'] - $row['clicks']) / $row['click_limit'] * 100;
                    echo "<div id='word-box-{$row['id']}' class='word-box $class' onclick='handleWordClick({$row['id']})' style='width: {$row['word_box_size']}px; height: {$row['word_box_size']}px;'>
                            <span class='word' style='font-size: {$row['word_size']}px;'>{$row['word']}</span>
                            <div class='progress-bar'>
                                <div class='progress' style='width: {$progress_width}%'></div>
                            </div>
                          </div>";

                    // Fetch and display total clicks
                    // Fetch and display total clicks
$sql = "SELECT COUNT(*) as total_clicks FROM visitor_clicks WHERE word_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $word_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_clicks = $row['total_clicks'];
echo "<div>Total Clicks: {$total_clicks}</div>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
