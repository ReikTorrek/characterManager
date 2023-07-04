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

    public function createCustomFieldData()
    {
        $data = [
            'name' => $this->id,
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
}