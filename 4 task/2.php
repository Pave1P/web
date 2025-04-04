<?php
$str = 'a12b34c5';
$result = preg_replace_callback(
    '/\[0-9]+/',
    function($matches) {
        $number = $matches[0];
        $sum = array_sum(str_split($number));
        return $sum;
    },
    $str
);
echo $result;