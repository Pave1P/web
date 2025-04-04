<?php
// Включение отображения ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Проверка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Защита от XSS
    $lastname = htmlspecialchars($_POST['lastname'] ?? '');
    $firstname = htmlspecialchars($_POST['firstname'] ?? '');
    $age = intval($_POST['age'] ?? 0);

    // Вывод результата
    echo <<<HTML
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Результат</title>
        <style>
            body { font-family: Arial; max-width: 500px; margin: 0 auto; padding: 20px; }
            .result { background: #f0f0f0; padding: 20px; border-radius: 8px; }
        </style>
    </head>
    <body>
        <div class="result">
            <h2>Ваши данные:</h2>
            <p><strong>Фамилия:</strong> {$lastname}</p>
            <p><strong>Имя:</strong> {$firstname}</p>
            <p><strong>Возраст:</strong> {$age}</p>
        </div>
        <a href="index.php">Вернуться</a>
    </body>
    </html>
    HTML;
} else {
    // Если форма не отправлена, перенаправляем обратно
    header('Location: index.php');
    exit;
}
?>
