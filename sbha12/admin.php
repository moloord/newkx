<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>

<body>
    <h1>Add Word, Word Box Size, Word Size, and Click Limit</h1>

    <form action="add_word.php" method="POST">
        <label for="word_box_name">Word Box Name:</label>
        <input type="text" name="word_box_name" id="word_box_name" required>

        <label for="word">Word:</label>
        <input type="text" name="word" id="word" required>
        
        <label for="word_box_size">Word Box Size:</label>
        <input type="number" name="word_box_size" id="word_box_size" required>

        <label for="word_size">Word Size:</label>
        <input type="number" name="word_size" id="word_size" required>

        <label for="click_limit">Click Limit:</label>
        <input type="number" name="click_limit" id="click_limit" required>

        <button type="submit">Add Word</button>
    </form>
</body>

</html>