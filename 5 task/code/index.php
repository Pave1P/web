<?php
// Категории из вашего задания
$categories = ['apps', 'games', 'programs'];

// Создаем папки категорий
foreach ($categories as $category) {
    if (!file_exists("categories/$category")) {
        mkdir("categories/$category", 0777, true);
    }
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email'] ?? '');
    $category = htmlspecialchars($_POST['category'] ?? '');
    $title = htmlspecialchars($_POST['title'] ?? '');
    $text = htmlspecialchars($_POST['text'] ?? '');
    
    // Генерация имени файла (заменяем спецсимволы на _)
    $safe_title = preg_replace('/[^\w\-]/u', '_', $title);
    $filename = "categories/$category/{$safe_title}_" . time() . '.txt';
    
    // Сохранение в файл
    file_put_contents($filename, "Email: $email\n\n$text");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Получение списка объявлений
$ads = [];
foreach ($categories as $category) {
    $files = glob("categories/$category/*.txt");
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $ads[] = [
            'category' => $category,
            'title' => basename($file, '.txt'),
            'content' => $content,
            'date' => date("Y-m-d H:i:s", filemtime($file))
        ];
    }
}

// Сортируем объявления по дате (новые сначала)
usort($ads, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доска объявлений</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select, textarea { width: 100%; padding: 8px; }
        button { padding: 10px 15px; background: #0066cc; color: white; border: none; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Доска объявлений</h1>
    
    <form method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="category">Категория:</label>
            <select id="category" name="category" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat ?>"><?= ucfirst($cat) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="title">Заголовок:</label>
            <input type="text" id="title" name="title" required>
        </div>
        
        <div class="form-group">
            <label for="text">Текст объявления:</label>
            <textarea id="text" name="text" rows="4" required></textarea>
        </div>
        
        <button type="submit">Добавить объявление</button>
    </form>
    
    <h2>Последние объявления</h2>
    <table>
        <thead>
            <tr>
                <th>Категория</th>
                <th>Заголовок</th>
                <th>Текст</th>
                <th>Дата</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ads as $ad): ?>
            <tr>
                <td><?= ucfirst($ad['category']) ?></td>
                <td><?= str_replace('_', ' ', $ad['title']) ?></td>
                <td><?= nl2br($ad['content']) ?></td>
                <td><?= $ad['date'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>