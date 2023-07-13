<?php
$fieldData = new CustomFieldData(CustomFieldData::getCustomFieldDataByFieldId($_POST['field_id']));
$fieldData->data = $_POST['data'];
$fieldData->color = $_POST['color'];
$fieldData->updateCustomFieldData();
echo json_encode(CustomFieldData::getCustomFieldData($fieldData->id));