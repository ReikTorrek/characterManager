<?php
$character = new Character(['name' => $_POST['name']]);
$character->user_id = $_COOKIE['userId'];
$characterId = $character->createCharacter();
foreach ($_POST['headerIds'] as $id) {
    $customFields = CustomField::getCustomFieldsByHeader($id);
    $customField = new CustomField($id);
    $customField->characterId = $characterId;
    $customField->linkCharacterWithField();
    foreach ($customFields as $field) {
        $customField = new CustomField($field);
        $customField->characterId = $characterId;
        $customField->linkCharacterWithField();
    }
}