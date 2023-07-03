<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once $_SERVER["DOCUMENT_ROOT"] . "/templates/autoload.php";

$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];
$url = mb_substr($url, -1) == "/" ? $url : $url."/";
$url_explode = trim($url, "/");
$url_explode = explode("/", $url_explode);
// Главная страница
if ($url == "/") {
    $styleList =[
    ];
    $scriptList = [
    ];

    $title = "Главная";
    $description = "";
    $data['h'] = "";
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/head.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/header.php';

    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/footer.php';

    exit();
}
if ($url == '/characters/') {
    $styleList =[
    ];
    $scriptList = [
    ];

    $title = "Персонажи";
    $description = "";
    $data['h'] = "";
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/head.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/header.php';
    require_once $_SERVER["DOCUMENT_ROOT"] .  '/modules/characters/controller/charactersController.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/footer.php';
    exit();
}
if ($url_explode[0] == 'character' && !empty($url_explode[1])) {
    $styleList =[
    ];
    $scriptList = [
        '/js/characterMain.js'
    ];

    $title = "Персонаж";
    $description = "";
    $data['h'] = "";
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/head.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/header.php';
    require_once $_SERVER["DOCUMENT_ROOT"] .  '/modules/character/controller/characterController.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/footer.php';
    exit();
}