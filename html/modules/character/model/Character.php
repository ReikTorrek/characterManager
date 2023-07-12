<?php

class Character
{
    public $id;
    public $name;
    public $user_id;
    public $custom_fields;

    public function __construct($character) {
        if (is_array($character)) { // Проверка массив ли входящий параметр, если да заполнить класс
            $this->fillSelf($character); // fillSelf - заполнение классом самого себя
        }elseif (is_numeric($character)) { // Если не массив, а число, тогда вытащить данные из БД и заполнить
            $character = Character::getCharacter($character); //Получить из БД одну запись
            $this->fillSelf($character); // Заполнить класс этой записью
        }
    }

    private function fillSelf($character) {
        $this->id = @$character['id'];
        $this->name = @$character['name'];
        $this->user_id = @$character['user_id'];
    }

    public static function getCharacter($id) {
        $array = [
            "id" => $id,
        ];
        $character = DB::getRow("SELECT * FROM characters WHERE id = :id", $array);
        return $character;
    }

    public static function getAllCharactersByUserId($userId): array
    {
        $characters = DB::getAll("SELECT * FROM characters WHERE user_id = " . $userId);
        foreach ($characters as $key => $value) {
            $objectscarsArray[$key] = new Character($value);
        }

        return $objectscarsArray;
    }

    public function getAllCustomFields(): void
    {
        $customFields = DB::getAll("SELECT * FROM custom_fields WHERE character_id = " . $this->id);
        foreach ($customFields as $key => $customField) {
            $customFields[$key]['data'] = $this->getCustomFieldData($customField['id']);
            $customFields[$key]['data_color'] = $this->getCustomFieldColor($customField['id']);
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
                    $this->custom_fields[$header['name']]['color'] = $customField['color'];
                }
            }
        }
    }

    public function getCustomHeader(): bool|array
    {
        return DB::getAll("SELECT * FROM custom_fields WHERE header_id IS NULL AND character_id = " . $this->id);
    }

    public function getCustomFieldData($fieldId)
    {
        return DB::getValue("SELECT data FROM custom_fields_data WHERE field_id = " . $fieldId);
    }
    public function getCustomFieldColor($fieldId)
    {
        return DB::getValue("SELECT color FROM custom_fields_data WHERE field_id = " . $fieldId);
    }

    public function createCharacter(): bool|int|string
    {
        $data = [
            'name' => $this->name,
            'user_id' => $this->user_id,
        ];

        return DB::add("INSERT INTO characters (`name`, `user_id`) VALUES (:name, :user_id)", $data);
    }

    public function deleteCharacter()
    {
        $characterFieldsIds = DB::getAll("SELECT id FROM custom_fields WHERE character_id = " . $this->id);
        foreach ($characterFieldsIds as $id) {
            DB::set("DELETE FROM custom_fields_data WHERE field_id = " . $id['id']);
        }
        DB::set("DELETE FROM custom_fields WHERE character_id = " . $this->id);
        return DB::set("DELETE FROM characters WHERE id = " . $this->id);
    }

}