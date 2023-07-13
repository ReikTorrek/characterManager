<?php
$data['headers'] = CustomField::getAllCustomFieldHeadersByUser($_COOKIE['userId']);
$data['custom_fields'] = CustomField::getAllCustomFieldsByUser($_COOKIE['userId']);
foreach ($data['custom_fields'] as $key => $custom_field) {
    foreach ($data['headers'] as $header) {
        if ($header['id'] == $custom_field['header_id']) {
            $data['custom_fields'][$header['id']][] = $custom_field;
            unset($data['custom_fields'][$key]);
        }
    }
}
View::render('/modules/character/view/createCharacterView.php', $data);