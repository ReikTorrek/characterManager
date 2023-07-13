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
        '/js/charactersMain.js'

    ];

    $title = "Персонажи";
    $description = "";
    $data['h'] = "";
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/head.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/header.php';
    if (!User::checkUserCookies()) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/error/notAuthed.php';
    }else {
        require_once $_SERVER["DOCUMENT_ROOT"] .  '/modules/characters/controller/charactersController.php';
    }
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/footer.php';
    exit();
}

if ($url == '/user/') {
    $styleList =[
        '/css/userMain.css',
    ];
    $scriptList = [
    ];

    $title = $_COOKIE['login'];
    $description = "";
    $data['h'] = "";

    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/head.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/header.php';
    require_once $_SERVER["DOCUMENT_ROOT"] .  '/modules/user/controller/userController.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/footer.php';
    exit();
}

if ($url == '/sign_in/') {
    $styleList =[
    ];
    $scriptList = [
    ];

    $title = "Авторизация";
    $description = "";
    $data['h'] = "";
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/head.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/header.php';
    require_once $_SERVER["DOCUMENT_ROOT"] .  '/modules/user/controller/authController.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/footer.php';
    exit();
}

if ($url == '/template/') {
    $styleList =[
    ];
    $scriptList = [
    ];

    $title = "Авторизация";
    $description = "";
    $data['h'] = "";
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/head.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/header.php';
    require_once $_SERVER["DOCUMENT_ROOT"] .  '/modules/customFields/controller/customFieldTemplatesController.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/footer.php';
    exit();
}

if ($url_explode[0] == 'character' && !empty($url_explode[1])) {
    $styleList =[
        '/css/characterMain.css',
    ];
    $scriptList = [
        '/js/characterMain.js'
    ];

    $title = "Персонаж";
    $description = "";
    $data['h'] = "";
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/head.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/header.php';
    if (!User::checkUserCookies()) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/error/notAuthed.php';
    }else {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/character/diceRollerModal.php';
        require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/character/modals/changeFieldModal.php';
        require_once $_SERVER["DOCUMENT_ROOT"] . '/modules/character/controller/characterController.php';
    }
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/footer.php';
    exit();
}

if ($url == '/create/') {
    $styleList =[
    ];
    $scriptList = [
        '/js/characterCreate.js'
    ];

    $title = "Создать персонажа";
    $description = "";
    $data['h'] = "";
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/head.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/header.php';
    if (!User::checkUserCookies()) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/error/notAuthed.php';
    }else {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/createCharacter/modals/addHeaderModal.php';
        require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/createCharacter/modals/addFieldModal.php';
        require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/createCharacter/modals/addFieldChildModal.php';
        require_once $_SERVER["DOCUMENT_ROOT"] . '/modules/character/controller/createCharacterController.php';
    }
    require_once $_SERVER["DOCUMENT_ROOT"] . '/templates/footer.php';
    exit();
}