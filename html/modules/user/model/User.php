<?php

class User
{
    public $id;
    public $login;
    public $password;
    public $mail;
    public $avatar;

    public function __construct($user) {
        if (is_array($user)) { // Проверка массив ли входящий параметр, если да заполнить класс
            User::fillSelf($user); // fillSelf - заполнение классом самого себя
        }elseif (is_numeric($user)) { // Если не массив, а число, тогда вытащить данные из БД и заполнить
            $user = User::getUser($user); //Получить из БД одну запись
            $this->fillSelf($user); // Заполнить класс этой записью
        }
    }

    private function fillSelf($user) {
        $this->id = $user['id'];
        $this->login = $user['login'];
        $this->password = $user['password'];
        $this->mail = $user['mail'];
        $this->avatar = $user['avatar'];
    }

    public static function getUser($id) {
        $array = [
            "id" => $id,
        ];
        $user = DB::getRow("SELECT * FROM users WHERE id = :id", $array);
        return $user;
    }
}