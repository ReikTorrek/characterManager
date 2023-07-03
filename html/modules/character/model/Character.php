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
        $customFields = DB::getAll("
        SELECT custom_fields.id, custom_fields.name, custom_fields.header_id, custom_fields.character_id, custom_fields_data.data
            FROM custom_fields 
            JOIN custom_fields_data ON custom_fields_data.field_id = custom_fields.id
            WHERE custom_fields.character_id = " . $this->id);

        $this->custom_fields = $customFields;
    }

}