<?php
// Конфигурации для подключения к БД
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydbtest";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function countProducts($categoryId, $conn) {
    $sql = "SELECT COUNT(*) AS total FROM products WHERE id_group = $categoryId";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total = $row['total'];

    $sql = "SELECT id FROM `Groups` WHERE id_parent = $categoryId";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $total += countProducts($row['id'], $conn);
    }

    return $total;
}
// Функция для рекурсивного создания дерева категорий
function createCategoryTree($categoryId, $conn) {
    $sql = "SELECT COUNT(*) AS total FROM products WHERE id_group = $categoryId";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalProducts = $row['total'];

    $sql = "SELECT id, `name` FROM `Groups` WHERE id_parent = $categoryId";
    $result = $conn->query($sql);

    $categoryName = $conn->query("SELECT `name` FROM `Groups` WHERE id = $categoryId")->fetch_assoc()['name'];

    $output = "<li> $categoryName $totalProducts - количество продуктов в этой категории<ul>";

    while ($row = $result->fetch_assoc()) {
        $subCategoryId = $row['id'];
        $subCategoryName = $row['name'];
        $output .= createCategoryTree($subCategoryId, $conn);
    }

    // Получение и вывод товаров для текущей категории
    $productSql = "SELECT id, `name` FROM `products` WHERE id_group = $categoryId";
    $productResult = $conn->query($productSql);

    while ($productRow = $productResult->fetch_assoc()) {
        $productId = $productRow['id'];
        $productName = $productRow['name'];
        $output .= "<li>Товар: ($productId) $productName</li>";
    }

    $output .= "</ul></li>";
    return $output;
}

// Получение дерева категорий и вывод результатов
$sql = "SELECT id, `name` FROM `Groups` WHERE id_parent = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        $categoryId = $row['id'];
        $categoryName = $row['name'];
        $totalProducts = countProducts($categoryId, $conn);
        echo "<li>($categoryId) $categoryName ($totalProducts - количество продуктов в этой категории)<ul>";
        echo createCategoryTree($categoryId, $conn);
        echo "</ul></li>";
    }
    echo "</ul>";
} else {
    echo "Нет данных о категориях.";
}

// Закрытие соединения
$conn->close();
?>
