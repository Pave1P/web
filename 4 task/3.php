<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
    $text = trim($_POST['text']);
    $words = preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);
    $space_words = 0;
    
    foreach ($words as $word) {
        if (mb_strpos($word, ' ') !== false) {
            $space_words++;
        }
    }
    
    echo "Количество слов с пробелами внутри: $space_words";
    echo '<p><a href="index.php">Назад</a></p>';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Счётчик слов с пробелами</title>
</head>
<body>
    <form method="post">
        <textarea name="text" cols="50" rows="10" placeholder="Введите текст..."></textarea><br>
        <input type="submit" value="Посчитать">
    </form>
</body>
</html>