<?php
class Helper
{
    public static function md5_this($string) {
        return md5($string);
    }

    /**
     * @param array $data
     * @return array
     */
    public static function checkNullFields(array $data) {
        foreach ($data as $key => $value) {
            if ($value == null) {
                unset($data[$key]);
            }
        }
        return $data;
    }
}