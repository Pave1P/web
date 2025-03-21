<?php
// 1. Функция, проверяющая сумму двух чисел
function isSumGreaterThanTen($a, $b) {
    return ($a + $b) > 10;
}

var_dump(isSumGreaterThanTen(5, 6)); 
var_dump(isSumGreaterThanTen(2, 3)); 

// 2. Функция, проверяющая равенство двух чисел
function areNumbersEqual($a, $b) {
    return $a == $b;
}

var_dump(areNumbersEqual(5, 5)); 
var_dump(areNumbersEqual(2, 3)); 

// 3. Сокращённая форма кода
$test = 0;
if ($test == 0) echo 'верно';

// 4. Проверка числа и суммы его цифр
$age = 25;

if ($age < 10 || $age > 99) {
    echo "Число меньше 10 или больше 99.\n";
} else {
    $sum = array_sum(str_split($age));
    if ($sum <= 9) {
        echo "Сумма цифр однозначна: $sum\n";
    } else {
        echo "Сумма цифр двузначна: $sum\n";
    }
}

// 5. Проверка количества элементов в массиве и их суммы
$arr = [1, 2, 3];

if (count($arr) == 3) {
    $sum = array_sum($arr);
    echo "Сумма элементов массива: $sum\n";
} else {
    echo "Массив не содержит 3 элемента.\n";
}
