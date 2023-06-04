<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/model/MapAutoloader.php';

$autoloader = new MapAutoloader();

spl_autoload_register(array($autoloader, 'autoload'));


$autoloader->registerClass('View', $_SERVER['DOCUMENT_ROOT'] . '/model/View.php');