<?php
// Включение отображения ошибок (для отладки)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ввод данных</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 0 auto; padding: 20px; }
        form { display: grid; gap: 15px; }
        input, button { padding: 10px; font-size: 16px; }
        button { background: #4CAF50; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Введите ваши данные</h2>
    <form action="result.php" method="post">
        <input type="text" name="lastname" placeholder="Фамилия" required>
        <input type="text" name="firstname" placeholder="Имя" required>
        <input type="number" name="age" placeholder="Возраст" min="1" max="120" required>
        <button type="submit">Отправить</button>
    </form>
</body>
</html>
