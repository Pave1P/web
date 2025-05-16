<?php
require_once 'ApiClient.php';

// Инициализация клиента с базовым URL OpenWeatherMap API
$weatherClient = new ApiClient('https://api.openweathermap.org/data/2.5');

// Установка API ключа (в реальном приложении хранить в конфиге)
$apiKey = 'ваш_api_ключ'; // Замените на реальный ключ

// Простое приложение для получения погоды
class WeatherApp {
    private $apiClient;
    private $apiKey;
    
    public function __construct($apiClient, $apiKey) {
        $this->apiClient = $apiClient;
        $this->apiKey = $apiKey;
    }
    
    /**
     * Получение текущей погоды по названию города
     * @param string $city Название города
     * @return array Данные о погоде
     */
    public function getCurrentWeather($city) {
        $params = [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric', // Для получения в градусах Цельсия
            'lang' => 'ru' // Русский язык ответа
        ];
        
        try {
            $response = $this->apiClient->get('/weather', $params);
            
            if ($response['status'] !== 200) {
                throw new Exception('Ошибка при получении данных о погоде');
            }
            
            return $this->formatWeatherData($response['data']);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    
    /**
     * Форматирование данных о погоде для вывода
     * @param array $weatherData Данные от API
     * @return array Отформатированные данные
     */
    private function formatWeatherData($weatherData) {
        return [
            'city' => $weatherData['name'],
            'temperature' => round($weatherData['main']['temp']) . '°C',
            'feels_like' => round($weatherData['main']['feels_like']) . '°C',
            'description' => ucfirst($weatherData['weather'][0]['description']),
            'humidity' => $weatherData['main']['humidity'] . '%',
            'pressure' => round($weatherData['main']['pressure'] / 1.333) . ' мм рт. ст.',
            'wind' => round($weatherData['wind']['speed']) . ' м/с'
        ];
    }
}

// Использование приложения
$weatherApp = new WeatherApp($weatherClient, $apiKey);

// Получаем погоду для Москвы
$weather = $weatherApp->getCurrentWeather('Moscow');

// Выводим результат
echo "<h2>Текущая погода в {$weather['city']}</h2>";
echo "<ul>";
echo "<li>Температура: {$weather['temperature']} (ощущается как {$weather['feels_like']})</li>";
echo "<li>Описание: {$weather['description']}</li>";
echo "<li>Влажность: {$weather['humidity']}</li>";
echo "<li>Давление: {$weather['pressure']}</li>";
echo "<li>Ветер: {$weather['wind']}</li>";
echo "</ul>";

// Пример с обработкой ошибки
$invalidWeather = $weatherApp->getCurrentWeather('НесуществующийГород');
if (isset($invalidWeather['error'])) {
    echo "<p style='color:red'>Ошибка: {$invalidWeather['error']}</p>";
}
?>