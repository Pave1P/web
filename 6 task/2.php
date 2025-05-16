<?php
// Часть 2: Работа с заголовками и параметрами

// 1. GET-запрос с кастомными заголовками
function getWithCustomHeaders($url, $headers = []) {
    $ch = curl_init($url);
    
    $formattedHeaders = [];
    foreach ($headers as $key => $value) {
        $formattedHeaders[] = "$key: $value";
    }
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $formattedHeaders);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        return json_decode($response, true);
    } else {
        throw new Exception("Request failed with status code: $httpCode");
    }
}

// 2. Отправка JSON-данных
function sendJsonRequest($url, $method, $data) {
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data))
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode >= 200 && $httpCode < 300) {
        return json_decode($response, true);
    } else {
        throw new Exception("$method request failed with status code: $httpCode");
    }
}

// 3. Запрос с параметрами URL
function getWithQueryParams($url, $params = []) {
    $queryString = http_build_query($params);
    $fullUrl = $url . (strpos($url, '?') === false ? '?' : '&') . $queryString;
    
    $ch = curl_init($fullUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        return json_decode($response, true);
    } else {
        throw new Exception("Request failed with status code: $httpCode");
    }
}

// Пример использования
try {
    // GET с кастомными заголовками
    $headers = [
        'Authorization' => 'Bearer token123',
        'X-Custom-Header' => 'CustomValue'
    ];
    $result = getWithCustomHeaders('https://jsonplaceholder.typicode.com/posts/1', $headers);
    print_r($result);
    
    // Отправка JSON
    $data = ['title' => 'JSON Request', 'body' => 'Content', 'userId' => 1];
    $jsonResponse = sendJsonRequest('https://jsonplaceholder.typicode.com/posts', 'POST', $data);
    print_r($jsonResponse);
    
    // GET с параметрами
    $params = ['userId' => 1, '_limit' => 5];
    $queryResult = getWithQueryParams('https://jsonplaceholder.typicode.com/posts', $params);
    print_r($queryResult);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>