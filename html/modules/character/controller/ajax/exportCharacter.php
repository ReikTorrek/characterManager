<?php

// Подключение к базе данных
$dbHost = "db";
$dbName = "local";
$dbUser = "local";
$dbPass = "local";

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
    die();
}

// Получение данных о персонаже
$characterId = $_POST['id']; // ID персонажа, данные о котором нужно экспортировать

try {
    $db->beginTransaction();

    // Запрос данных о персонаже из таблицы "characters"
    $sql = "SELECT * FROM characters WHERE id = :character_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':character_id', $characterId, PDO::PARAM_INT);
    $stmt->execute();
    $characterData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Запрос пользовательских полей персонажа из таблиц "custom_fields" и "custom_fields_data"
    $sql = "SELECT cf.name, cf.header_id, cf.character_id, cf.color, cf.sort, cfd.field_id, cfd.data, cfd.color
            FROM custom_fields cf
            LEFT JOIN custom_fields_data cfd ON cf.id = cfd.field_id
            WHERE cf.character_id = :character_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':character_id', $characterId, PDO::PARAM_INT);
    $stmt->execute();
    $customFieldsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Запрос картинок персонажа из таблицы "character_images"
    $sql = "SELECT url FROM character_images WHERE character_id = :character_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':character_id', $characterId, PDO::PARAM_INT);
    $stmt->execute();
    $imagesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db->commit();
} catch(PDOException $e) {
    $db->rollback();
    echo "Ошибка при получении данных о персонаже: " . $e->getMessage();
    die();
}

// Сохранение данных о персонаже в файле
$exportData = [
    'character_data' => $characterData,
    'custom_fields_data' => $customFieldsData,
    'images_data' => $imagesData,
];

$exportJson = json_encode($exportData, JSON_PRETTY_PRINT);
//file_put_contents('character_export.json', $exportJson);
$file = $characterData['name'] . '.json';
if (file_put_contents($file, $exportJson) !== false) {
    // Установка заголовков для скачивания файла
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Length: ' . filesize($file));
    header('Pragma: no-cache');
    header('Expires: 0');
    readfile($file);
    unlink($file);
    exit;
} else {
    echo "Ошибка при сохранении файла character_export.json";
}
//echo "Данные о персонаже успешно экспортированы и сохранены в файл character_export.json\n";
?>
