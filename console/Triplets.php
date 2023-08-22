<?php
// Проверяем, идут ли цифры числа по порядку
function containsAscendingTriplet($num)
{
    $numStr = strval($num);
    for ($i = 0; $i <= strlen($numStr) - 3; $i++) {
        if ($numStr[$i] == $numStr[$i + 1] - 1 && $numStr[$i] == $numStr[$i + 2] - 2) {
            return true;
        }
    }
    return false;
}

// Создаём необходимый массив
$numbers = range(1, 10000);

// Убираем лишнее из массива
$filteredNumbers = array_filter($numbers, function ($num) {
    return !containsAscendingTriplet($num);
});

// Суммируем оставшиеся
$sum = array_sum($filteredNumbers);

// Выводим
echo "Сумма оставшихся чисел: " . $sum;
?>