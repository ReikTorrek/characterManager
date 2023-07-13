<?php
$header = new CustomField($_POST['id']);
$header->name = !$_POST['name'] ? $header->name : $_POST['name'] ;
$header->color = !$_POST['color'] ? $header->color : $_POST['color'];
$header->headerId = !$_POST['header_id'] ? $header->headerId : $_POST['header_id'];
$header->updateCustomField();
echo json_encode(CustomField::getCustomField($header->id));