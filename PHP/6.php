<?php

$a = 10;
$b = 3;
echo $a % $b, "\n";

echo "Переменная a: ";
$a = fgets(STDIN);
echo "Переменная b: ";
$b = fgets(STDIN);
if ($a % $b == 0) {
    echo "Делится ", $a / $b, "\n";
} else {
    echo "Делится с остатком ", $a % $b, "\n";
}


$st = 2**10;
$sqrtNum = 245**1/2;

$array = array(4, 2, 5, 19, 13, 0, 10);
$sumSqr = 0;
foreach ($array as $value) {
    $sumSqr += $value**2;
}

echo "2 в десятой стпени: ", $st,
"\n Корень квадратный из числа 245: ", $sqrtNum,
"\nКорень из суммы квадратов элементов массива: ", sqrt($sumSqr), "\n";


$num1 = sqrt(379);
$sqrtNum0 = round($num1);
$sqrtNum1 = round($num1, 1);
$sqrtNum2 = round($num1, 2);

$num2 = sqrt(587);
$array = ['floor' => floor($num2), 'ceil' => ceil($num2)];

echo "Результаты округления корня из числа 379:",
"\n$sqrtNum0", "\n$sqrtNum1", "\n$sqrtNum2";
echo "\nРезультат округления корня из числа 587: ";
var_dump($array);


$array = [4, -2, 5, 19, -130, 0, 10];
echo "минимальное значение в массиве: ", min($array),
"\nмаксимальное значение в массиве: ", max($array), "\n";


echo "Случайное число: ", rand(1, 100), "\n";

$array = [];
for ($i = 0; $i < 10; $i++) {
    $array[$i] = rand(1, 100);
}
var_dump($array);


$a = 123;
$b = 456;
echo '|a - b| = ', abs($a - $b);
echo "\n|b - a| = ", abs($b - $a), "\n";

$array = [1, 2, -1, -2, 3, -3];
$newArray = array_map('abs', $array);
var_dump($newArray);


echo "Введите число для вывода делителей введённого числа: ";
$a = fgets(STDIN);

$arrayDivisor = [];
for ($d = 1; $d <= $a/2; $d++) {
    if ($a % $d == 0) {
        $arrayDivisor[] = $d;
    }
}

$arrayDivisor[] = intval($a);
echo "Делители числа {$a}:\n";
var_dump($arrayDivisor);

$array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$sum = 0;
$count = 0;
foreach ($array as $value) {
    if ($sum <= 10) {
        $sum += $value;
        $count++;
    }
}
echo "чтобы сумма получилась больше 10, надо сложить первые {$count} чисел.";