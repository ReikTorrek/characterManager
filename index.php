<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/templates/autoload.php";

$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];
$url = mb_substr($url, -1) == "/" ? $url : $url."/";
$url_explode = trim($url, "/");
$url_explode = explode("/", $url_explode);
var_dump($url);
// Главная страница
if ($url == "/") {
    $styleList =[
    ];
    $scriptList = [
    ];

    $title = "";
    $description = "";
    $data['h'] = "";

    exit();
}
if ($url == '/character/') {
    $styleList =[
    ];
    $scriptList = [
    ];

    $title = "Персонаж";
    $description = "";
    $data['h'] = "";
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/head.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/header.php';
    require_once $_SERVER["DOCUMENT_ROOT"] .  '/modules/characters/controller/characterController.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/footer.php';
    exit();
}
// Главная страница