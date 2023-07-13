<?php
$customFieldData = new CustomFieldData(CustomFieldData::getCustomFieldDataByFieldId($_POST['field_id']));
$customFieldData->data = $_POST['value'];
$customFieldData->updateCustomFieldData();