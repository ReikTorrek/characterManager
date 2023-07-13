<?php

class Character
{
    public $id;
    public $name;
    public $user_id;
    public $custom_fields;
    public $is_deleted;

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
        $this->is_deleted = @$character['is_deleted'];
    }

    public static function getCharacter($id) {
        $array = [
            "id" => $id,
        ];
        $character = DB::getRow("SELECT * FROM characters WHERE id = :id", $array);
        return $character;
    }

    public static function getAllCharactersByUserId($userId): array|int
    {
        $data = [
          'user_id' => $userId,
          'is_deleted' => 0,
        ];
        $characters = DB::getAll("SELECT * FROM characters WHERE user_id = :user_id AND is_deleted = :is_deleted", $data);
        if (!$characters) {
            return 0;
        }
        foreach ($characters as $key => $value) {
            $objectscarsArray[$key] = new Character($value);
        }

        return $objectscarsArray;
    }

    public function getAllCustomFields(): void
    {
        $headers = $this->getCustomHeader();
        foreach ($headers as $key => $header) {
            $headerChildren = $this->getCustomHeaderChildren($header['id']);
            foreach ($headerChildren as $keyy => $child) {
                $headerChildren[$keyy]['data'] = $this->getCustomFieldData($child['id']);
                $headerChildren[$keyy]['data_color'] = $this->getCustomFieldDataColor($child['id']);
                $headerChildren[$keyy]['children'] = $this->getCustomHeaderChildren($child['id']);
                foreach ($headerChildren[$keyy]['children'] as $keyyy => $headerChild) {
                    $headerChildren[$keyy]['children'][$keyyy]['data'] = $this->getCustomFieldData($headerChild['id']);
                    $headerChildren[$keyy]['children'][$keyyy]['data_color'] = $this->getCustomFieldDataColor($headerChild['id']);
                }
            }
            $headers[$key]['children'] = $headerChildren;
        }
        usort($headers, function($a, $b){
            return ($a['sort'] - $b['sort']);
        });
        $this->custom_fields = $headers;
    }

    public function getCustomHeader(): bool|array
    {
        return DB::getAll("SELECT * FROM custom_fields WHERE header_id IS NULL AND character_id = " . $this->id);
    }

    public function getCustomHeaderChildren($headerId)
    {
        return DB::getAll("SELECT * FROM custom_fields WHERE header_id = " . $headerId . " AND character_id = " . $this->id);
    }

    public function getCustomFieldData($fieldId)
    {
        return DB::getValue("SELECT data FROM custom_fields_data WHERE field_id = " . $fieldId);
    }
    public function getCustomFieldDataColor($fieldId)
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

    public function softDeleteCharacter()
    {
        return DB::set("UPDATE characters SET is_deleted = 1 WHERE id = " . $this->id);
    }

}