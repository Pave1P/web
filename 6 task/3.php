<?php
// Часть 3: Обработка ответов и ошибок

// 1. Обработка успешного ответа
function handleResponse($response) {
    $data = json_decode($response, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Failed to parse JSON response: " . json_last_error_msg());
    }
    
    return $data;
}

// 2. Обработка ошибок HTTP
function handleHttpError($httpCode, $response) {
    switch ($httpCode) {
        case 400:
            throw new Exception("Bad Request: " . $response);
        case 401:
            throw new Exception("Unauthorized: " . $response);
        case 403:
            throw new Exception("Forbidden: " . $response);
        case 404:
            throw new Exception("Not Found: " . $response);
        case 500:
            throw new Exception("Internal Server Error: " . $response);
        case 503:
            throw new Exception("Service Unavailable: " . $response);
        default:
            if ($httpCode >= 400 && $httpCode < 500) {
                throw new Exception("Client Error ($httpCode): " . $response);
            } elseif ($httpCode >= 500) {
                throw new Exception("Server Error ($httpCode): " . $response);
            }
    }
}

// 3. Обработка исключений cURL
function makeRequest($url, $options = []) {
    $ch = curl_init($url);
    
    $defaultOptions = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTPHEADER => ['Accept: application/json']
    ];
    
    curl_setopt_array($ch, $defaultOptions);
    
    if (!empty($options)) {
        curl_setopt_array($ch, $options);
    }
    
    try {
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            throw new Exception("cURL error: " . curl_error($ch));
        }
        
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if ($httpCode >= 200 && $httpCode < 300) {
            return handleResponse($response);
        } else {
            handleHttpError($httpCode, $response);
        }
    } catch (Exception $e) {
        throw new Exception("Request failed: " . $e->getMessage());
    } finally {
        curl_close($ch);
    }
}

// Пример использования
try {
    $response = makeRequest('https://jsonplaceholder.typicode.com/posts/1');
    print_r($response);
    
    // Пример запроса с ошибкой
    $errorResponse = makeRequest('https://jsonplaceholder.typicode.com/nonexistent');
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>