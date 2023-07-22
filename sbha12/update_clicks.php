<?php
session_start();

require_once 'db.php';

if (isset($_GET['word_id'])) {
    $word_id = $_GET['word_id'];

    // Fetch the word data
    $sql = "SELECT id, word, click_limit, clicks, word_size FROM words WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $word_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if the word is "completed"
    if ($row['clicks'] < $row['click_limit']) {
        // Increment the clicks in the words table
        $sql = "UPDATE words SET clicks = clicks + 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $word_id);
        $stmt->execute();

        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            $sql = "INSERT INTO visitor_clicks (user_id, word_id, clicks) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE clicks = clicks + 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $id, $word_id);
        } else {
            $id = $_SERVER['REMOTE_ADDR'];
            $sql = "INSERT INTO visitor_clicks (ip, word_id, clicks) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE clicks = clicks + 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $id, $word_id);
        }
        $stmt->execute();

        // Fetch the updated word data
        $sql = "SELECT id, word, click_limit, clicks, word_size FROM words WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $word_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    }

    // Generate the updated word box inner HTML
    $clickable = $row['clicks'] < $row['click_limit'];
    $class = $clickable ? "clickable": "non-clickable";
    $progress_width = ($row['click_limit'] - $row['clicks']) / $row['click_limit'] * 100;
    $word_size = $row['word_size'];
    $wordBoxInnerHTML = "<span class='word' style='font-size: {$word_size}px;'>{$row['word']}</span>
                         <div class='progress-bar'>
                             <div class='progress' style='width: {$progress_width}%'></div>
                         </div>";

    // Return the updated word box inner HTML
    echo $wordBoxInnerHTML;
}
?>