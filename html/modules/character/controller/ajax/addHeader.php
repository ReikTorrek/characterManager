<?php
//dd($_POST);
$customField = new CustomField($_POST);
$customField->userId = $_COOKIE['userId'];
$id = $customField->createCustomField();
echo json_encode(CustomField::getCustomField($id));