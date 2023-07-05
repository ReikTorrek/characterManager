<?php

class CustomField
{
    public $id;
    public $name;
    public $headerId;
    public $characterId;
    public $userId;
    public $color;
    public $sort;

    public function __construct($customField) {
        if (is_array($customField)) { // Проверка массив ли входящий параметр, если да заполнить класс
            $this->fillSelf($customField); // fillSelf - заполнение классом самого себя
        }elseif (is_numeric($customField)) { // Если не массив, а число, тогда вытащить данные из БД и заполнить
            $customField = CustomField::getCustomField($customField); //Получить из БД одну запись
            $this->fillSelf($customField); // Заполнить класс этой записью
        }
    }

    private function fillSelf($customField) {
        $this->id = @$customField['id'];
        $this->name = @$customField['name'];
        $this->headerId = @$customField['header_id'];
        $this->characterId = @$customField['character_id'];
        $this->userId = @$customField['user_id'];
        $this->color = @$customField['color'];
        $this->sort = @$customField['sort'];
    }

    public static function getCustomField($id) {
        $array = [
            "id" => $id,
        ];
        return DB::getRow("SELECT * FROM custom_fields WHERE id = :id", $array);
    }

    public function createCustomField(): bool|int|string
    {
        $data = [
            'name' => $this->name,
            'header_id' => $this->headerId,
            'character_id' => $this->characterId,
            'user_id' => $this->userId,
            'color' => $this->color,
            'sort' => $this->sort,
        ];
        $data = Helper::checkNullFields($data);
        $query = "INSERT INTO custom_fields (";
        $query .= implode(', ', array_map(function ($key) {
                return '`' . $key . '`';
        }, array_keys($data)))  . ") VALUES (";
        $query .= implode(', ', array_map(function ($value) {
                return "'" . $value . "'";
            }, $data))  . ")";

        return DB::add($query);
    }

    public function deleteCustomField(): bool
    {
        $data = [
            'id' => $this->id,
        ];
        return DB::set("DELETE FROM custom_fields WHERE id = :id", $data);

    }

    public static function getCustomFieldsByHeader($headerId): bool|array
    {
        return DB::getAll("SELECT * FROM custom_fields WHERE header_id = " . $headerId);
    }

    public function linkCharacterWithField(): void
    {
        $data = [
          'id' => $this->id,
          'character_id' => $this->characterId,
        ];

        DB::set("UPDATE custom_fields SET character_id = :character_id WHERE id = :id", $data);
    }
}