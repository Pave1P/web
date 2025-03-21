<?php
// 1. Заполнение массива 
$array = [];
for ($i = 1; $i <= 5; $i++) {
    $array[] = str_repeat('x', $i);
}
print_r($array);

// 2. Функция arrayFill
function arrayFill($value, $count) {
    return array_fill(0, $count, $value);
}
$result = arrayFill('x', 5);
print_r($result);

// 3. Сумма элементов двухмерного массива
$array = [[1, 2, 3], [4, 5], [6]];
$sum = 0;
foreach ($array as $subArray) {
    $sum += array_sum($subArray);
}
echo "Сумма элементов: $sum\n";

// 4. Создание массива [[1, 2, 3], [4, 5, 6], [7, 8, 9]]
$array = [];
$count = 1;
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        $array[$i][$j] = $count++;
    }
}
print_r($array);

// 5. Умножение и сложение элементов массива
$array = [2, 5, 3, 9];
$result = ($array[0] * $array[1]) + ($array[2] * $array[3]);
echo "Результат: $result\n";

// 6. Массив $user с выводом ФИО
$user = [
    'name' => 'Иван',
    'surname' => 'Иванов',
    'patronymic' => 'Иванович'
];
echo "$user[surname] $user[name] $user[patronymic]\n";

// 7. Массив $date с текущей датой
$date = [
    'year' => date('Y'),
    'month' => date('m'),
    'day' => date('d')
];
echo "$date[year]-$date[month]-$date[day]\n";

// 8. Количество элементов в массиве
$arr = ['a', 'b', 'c', 'd', 'e'];
echo "Количество элементов: " . count($arr) . "\n";

// 9. Последний и предпоследний элементы массива
$lastElement = end($arr);
$secondLastElement = $arr[count($arr) - 2];
echo "Последний элемент: $lastElement\n";
echo "Предпоследний элемент: $secondLastElement\n";
