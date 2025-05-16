<?php
/**
 * Класс для работы с API через cURL
 */
class ApiClient {
    private $baseUrl;
    private $authType;
    private $authToken;
    private $username;
    private $password;
    private $headers = [];
    
    /**
     * Конструктор
     * @param string $baseUrl Базовый URL API
     */
    public function __construct($baseUrl) {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->headers = [
            'Accept: application/json',
            'Cache-Control: no-cache'
        ];
    }
    
    /**
     * Установка Bearer Token аутентификации
     * @param string $token Токен доступа
     */
    public function setBearerToken($token) {
        $this->authType = 'bearer';
        $this->authToken = $token;
    }
    
    /**
     * Установка Basic Auth аутентификации
     * @param string $username Логин
     * @param string $password Пароль
     */
    public function setBasicAuth($username, $password) {
        $this->authType = 'basic';
        $this->username = $username;
        $this->password = $password;
    }
    
    /**
     * Добавление кастомного заголовка
     * @param string $header Заголовок
     */
    public function addHeader($header) {
        $this->headers[] = $header;
    }
    
    /**
     * Базовый метод для выполнения запросов
     * @param string $method HTTP-метод
     * @param string $endpoint Конечная точка
     * @param array|null $data Данные для отправки
     * @return array Ответ API
     */
    public function request($method, $endpoint, $data = null) {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        $headers = $this->headers;
        
        // Добавляем заголовки аутентификации
        if ($this->authType === 'bearer' && $this->authToken) {
            $headers[] = 'Authorization: Bearer ' . $this->authToken;
        } elseif ($this->authType === 'basic' && $this->username && $this->password) {
            $headers[] = 'Authorization: Basic ' . base64_encode($this->username . ':' . $this->password);
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        
        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $headers[] = 'Content-Type: application/json';
        }
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }
        
        curl_close($ch);
        
        return [
            'status' => $httpCode,
            'data' => json_decode($response, true)
        ];
    }
    
    // Короткие методы для основных HTTP-методов
    
    public function get($endpoint, $params = []) {
        $query = empty($params) ? '' : '?' . http_build_query($params);
        return $this->request('GET', $endpoint . $query);
    }
    
    public function post($endpoint, $data) {
        return $this->request('POST', $endpoint, $data);
    }
    
    public function put($endpoint, $data) {
        return $this->request('PUT', $endpoint, $data);
    }
    
    public function delete($endpoint) {
        return $this->request('DELETE', $endpoint);
    }
}