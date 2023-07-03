<?php

class Character
{
    public $id;
    public $name;
    public $custom_fields;

    public function __construct($character) {
        if (is_array($character)) { // Проверка массив ли входящий параметр, если да заполнить класс
            Character::fillSelf($character); // fillSelf - заполнение классом самого себя
        }elseif (is_numeric($character)) { // Если не массив, а число, тогда вытащить данные из БД и заполнить
            $character = Character::getCharacter($character); //Получить из БД одну запись
            $this->fillSelf($character); // Заполнить класс этой записью
        }
    }

    private function fillSelf($character) {
        $this->id = $character['id'];
        $this->name = $character['name'];
    }

    public static function getCharacter($id) {
        $array = [
            "id" => $id,
        ];
        $character = DB::getRow("SELECT * FROM characters WHERE id = :id", $array);
        return $character;
    }

    public static function getAllCharacters() {
        $characters = DB::getAll("SELECT * FROM characters");
        foreach ($characters as $key => $value) {
            $objectscarsArray[$key] = new Character($value);
        }

        return $objectscarsArray;
    }

    public function getAllCustomFields()
    {
        $customFields = DB::getAll("SELECT * FROM custom_fields WHERE character_id = " . $this->id);
        foreach ($customFields as $key => $customField) {
            $customFields[$key]['data'] = $this->getCustomFieldData($customField['id']);
        }
        $headers = $this->getCustomHeader();
        usort($headers, function($a, $b){
            return ($a['sort'] - $b['sort']);
        });
        foreach ($headers as $header) {
            foreach ($customFields as $customField) {
                if ($header['id'] == $customField['header_id']) {
                    $this->custom_fields[$header['name']][] = $customField;
                    $this->custom_fields[$header['name']]['header_id'] = $customField['header_id'];
                }
            }
        }
    }

    public function getCustomHeader()
    {
        return DB::getAll("SELECT name, id, sort FROM custom_fields WHERE header_id IS NULL AND character_id = " . $this->id);
    }

    public function getCustomFieldData($fieldId)
    {
        return DB::getValue("SELECT data FROM custom_fields_data WHERE field_id = " . $fieldId);
    }

}