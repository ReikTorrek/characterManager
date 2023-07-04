<?php
$customFieldData = new CustomFieldData($_POST);
$id = $customFieldData->createCustomFieldData();
echo json_encode(CustomFieldData::getCustomFieldData($id));