<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Boxes</title>
    <link rel="stylesheet" href="index_br.css">
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
        <h1>Word Boxes</h1>
    </header>
    
<div class="word-boxes-container">
<h2>Word Boxes</h2>
    <div class="word-container">
    
        <?php
        require_once "db.php";

        $result = $conn->query("SELECT id, word_box_name, word, click_limit, clicks FROM words");

        while ($row = $result->fetch_assoc()) {
            echo "<div class='ag-courses_item'>
                    <a href='word_box.php?word_id={$row['id']}' class='ag-courses-item_link'>
                        <div class='ag-courses-item_bg'></div>
                        <div class='ag-courses-item_title'>{$row['word_box_name']}</div>
                    </a>
                  </div>";
        }
        ?>
    </div>
</div>
</body>
</html>
