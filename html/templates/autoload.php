<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/model/MapAutoloader.php';

$autoloader = new MapAutoloader();

spl_autoload_register(array($autoloader, 'autoload'));


$autoloader->registerClass('View', $_SERVER['DOCUMENT_ROOT'] . '/model/View.php');
$autoloader->registerClass('DB', $_SERVER['DOCUMENT_ROOT'] . '/model/db.php');
$autoloader->registerClass('Helper', $_SERVER['DOCUMENT_ROOT'] . '/model/Helper.php');
$autoloader->registerClass('Character', $_SERVER['DOCUMENT_ROOT'] . '/modules/character/model/Character.php');
$autoloader->registerClass('CustomField', $_SERVER['DOCUMENT_ROOT'] . '/modules/customFields/model/CustomField.php');
$autoloader->registerClass('CustomFieldData', $_SERVER['DOCUMENT_ROOT'] . '/modules/customFields/model/CustomFieldData.php');
$autoloader->registerClass('User', $_SERVER['DOCUMENT_ROOT'] . '/modules/user/model/User.php');