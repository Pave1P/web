<?php
// 1. GET-запрос - получение списка постов
function getPosts() {
    $url = 'https://jsonplaceholder.typicode.com/posts';
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "GET запрос (получение постов):\n";
    echo "HTTP код: $httpCode\n";
    echo "Первые 3 поста из ответа:\n";
    $posts = json_decode($response, true);
    print_r(array_slice($posts, 0, 3));
    echo "\n";
}

// 2. POST-запрос - создание нового поста
function createPost() {
    $url = 'https://jsonplaceholder.typicode.com/posts';
    $data = [
        'title' => 'Новый пост',
        'body' => 'Содержание нового поста',
        'userId' => 1
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "POST запрос (создание поста):\n";
    echo "HTTP код: $httpCode\n";
    echo "Ответ сервера:\n";
    print_r(json_decode($response, true));
    echo "\n";
}

// 3. PUT-запрос - обновление существующего поста
function updatePost() {
    $url = 'https://jsonplaceholder.typicode.com/posts/1';
    $data = [
        'id' => 1,
        'title' => 'Обновленный заголовок',
        'body' => 'Обновленное содержание поста',
        'userId' => 1
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "PUT запрос (обновление поста):\n";
    echo "HTTP код: $httpCode\n";
    echo "Ответ сервера:\n";
    print_r(json_decode($response, true));
    echo "\n";
}

// 4. DELETE-запрос - удаление поста
function deletePost() {
    $url = 'https://jsonplaceholder.typicode.com/posts/1';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "DELETE запрос (удаление поста):\n";
    echo "HTTP код: $httpCode\n";
    echo "Ответ сервера:\n";
    print_r(json_decode($response, true));
    echo "\n";
}

// Выполняем все запросы по очереди
getPosts();
createPost();
updatePost();
deletePost();
?>