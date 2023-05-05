<?php

// Массив URL-адресов изображений
$imageUrls = array(
    'https://images.satu.kz/182234695_udobrenie-ph-perfect.jpg',
    'https://images.satu.kz/180056163_udobrenie-ph-perfect.jpg',
	'https://images.satu.kz/180056165675_udobrenie-ph-perfet.jpg',
    'https://images.satu.kz/191059352_udobrenie-ph-perfect.jpg',
);

// Папка для сохранения изображений
$folder = './images/';

// Создаем папку, если ее нет
if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

// Проходим по массиву URL-адресов изображений
foreach ($imageUrls as $imageUrl) {
    // Определяем имя файла из URL-адреса
    $fileName = basename($imageUrl);

    // Определяем путь к файлу на сервере
    $filePath = $folder . $fileName;

    // Открываем файл для записи
    $file = fopen($filePath, 'w');

    // Инициализируем cURL-сессию
    $curl = curl_init($imageUrl);

    // Устанавливаем параметры cURL-сессии
    curl_setopt($curl, CURLOPT_FILE, $file);
    curl_setopt($curl, CURLOPT_HEADER, 0);

    // Выполняем запрос на скачивание изображения
    curl_exec($curl);

    // Проверяем код ответа на предмет ошибок
    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($statusCode != 200) {
        echo "<br><br> <span style='color:red;'>Не удалось скачать изображение</span> $imageUrl (код ответа $statusCode)\n";
    }

    // Закрываем cURL-сессию
    curl_close($curl);

    // Закрываем файл
    fclose($file);

    // Выводим сообщение об успешном скачивании
    echo "<br><br>Изображение $imageUrl успешно скачано и сохранено в $filePath\n";
}
Проверка версии
?>
