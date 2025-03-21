<?php
// 1. Функция increaseEnthusiasm()
function increaseEnthusiasm($str) {
    return $str . "!";
}

echo increaseEnthusiasm("Привет") . "\n"; 

// 2. Функция repeatThreeTimes()
function repeatThreeTimes($str) {
    return $str . $str . $str;
}

echo repeatThreeTimes("PHP") . "\n"; 

// 3. Комбинирование функций
echo increaseEnthusiasm(repeatThreeTimes("Ура")) . "\n"; 

// 4. Функция cut()
function cut($str, $length = 10) {
    return substr($str, 0, $length);
}

echo cut("Это длинная строка", 5) . "\n"; // Это д
echo cut("Это длинная строка") . "\n";    // Это длинна

// 5. Рекурсивный вывод массива
function printArrayRecursively($array, $index = 0) {
    if ($index < count($array)) {
        echo $array[$index] . "\n";
        printArrayRecursively($array, $index + 1);
    }
}

$numbers = [1, 2, 3, 4, 5];
printArrayRecursively($numbers);

// 6. Сложение цифр числа
function sumDigits($number) {
    while ($number > 9) {
        $number = array_sum(str_split($number));
    }
    return $number;
}

echo sumDigits(12345) . "\n"; 