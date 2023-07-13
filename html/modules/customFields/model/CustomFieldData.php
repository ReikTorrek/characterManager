<?php

class CustomFieldData
{
    public $id;
    public $fieldId;
    public $data;
    public $color;
    public function __construct($customFieldData) {
        if (is_array($customFieldData)) { // Проверка массив ли входящий параметр, если да заполнить класс
            $this->fillSelf($customFieldData); // fillSelf - заполнение классом самого себя
        }elseif (is_numeric($customFieldData)) { // Если не массив, а число, тогда вытащить данные из БД и заполнить
            $customFieldData = CustomFieldData::getCustomFieldData($customFieldData); //Получить из БД одну запись
            $this->fillSelf($customFieldData); // Заполнить класс этой записью
        }
    }

    private function fillSelf($customFieldData) {
        $this->id = @$customFieldData['id'];
        $this->fieldId = @$customFieldData['field_id'];
        $this->data = @$customFieldData['data'];
        $this->color = @$customFieldData['color'];
    }

    public static function getCustomFieldData($id) {
        $array = [
            "id" => $id,
        ];
        return DB::getRow("SELECT * FROM custom_fields_data WHERE id = :id", $array);
    }
    public static function getCustomFieldDataByFieldId($id) {
        $array = [
            "field_id" => $id,
        ];
        return DB::getRow("SELECT * FROM custom_fields_data WHERE field_id = :field_id", $array);
    }

    public function createCustomFieldData(): bool|int|string
    {
        $data = [
            'field_id' => $this->fieldId,
            'data' => $this->data,
            'color' => $this->color,
        ];
        $data = Helper::checkNullFields($data);
        $query = "INSERT INTO custom_fields_data (";
        $query .= implode(', ', array_map(function ($key) {
                return '`' . $key . '`';
            }, array_keys($data)))  . ") VALUES (";
        $query .= implode(', ', array_map(function ($value) {
                return "'" . $value . "'";
            }, $data))  . ")";

        return DB::add($query);
    }

    public function deleteCustomFieldData(): bool
    {
        $data = [
            'id' => $this->id,
        ];
        return DB::set("DELETE FROM custom_fields_data WHERE id = :id", $data);

    }

    public function updateCustomFieldData(): void
    {
        $data = [
            'id' => $this->id,
            'field_id' => $this->fieldId,
            'data' => $this->data,
            'color' => $this->color,
        ];

        DB::set("UPDATE custom_fields_data SET field_id = :field_id, data = :data, color = :color WHERE id = :id", $data);
    }
}