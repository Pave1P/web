<?php
$str = 'uju uku uljju umju untu utou upu uqu uru usu utu uvu uwu uxu';
// Вариант 21 'u' + два любых символа + 'u'
$matches=[];
preg_match_all('/(u..u)/', $str, $matches);
print_r($matches[0]);