<?php
// Можете поменять ссылку для проверки на любую другую
$pageContent = file_get_contents("https://kmg-kumkol.kz/company/"); // Замените ссылкой на нужную страницу

// Преобразуем содержимое в нижний регистр для учета всех вхождений буквы "з"
$lowerCaseContent = mb_strtolower($pageContent);

// Регулярка для поиска анкоров ссылок
$linkRegex = '/<a\b[^>]*>(.*?)<\/a>/si';

// Инициализируем переменную для подсчета количества букв "з"
$countZ = 0;

// Находим все анкоры ссылок
preg_match_all($linkRegex, $lowerCaseContent, $matches);

if (isset($matches[1])) {
    foreach ($matches[1] as $linkText) {
        // Убираем HTML теги и считаем количество букв "з"
        $countZ += mb_substr_count(strip_tags($linkText), 'з');
    }
}

// Вывод
echo "Количество вхождений буквы 'з' внутри анкоров ссылок: " . $countZ;


?>