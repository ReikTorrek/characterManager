<?php
foreach ($_POST['headerIds'] as $id) {
    $customFields = CustomField::getCustomFieldsByHeader($id);
    $customField = new CustomField($id);
    $isDeleted = $customField->deleteCustomField();
    foreach ($customFields as $field) {
        $customField = new CustomField($field);
        $customFieldData = new CustomFieldData(CustomFieldData::getCustomFieldDataByFieldId($customField->id));
        $customFieldData->deleteCustomFieldData();
        $customField->deleteCustomField();
    }
}