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
            $this->fillSelf($user); // fillSelf - заполнение классом самого себя
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

    public static function getUserByLogin($login)
    {
        $user = DB::getRow("SELECT * FROM users WHERE login = '" . $login . "'");
        if ($user) {
            return new User($user);
        }else {
            return false;
        }
    }

    public function addUserCoockies()
    {
        setcookie('userId', $this->id, time() + 60*60*24*30, '/');
        setcookie('login', $this->login, time() + 60*60*24*30, '/');
        setcookie('password', $this->password, time() + 60*60*24*30, '/');
    }

    public function clearUserCookies()
    {
        setcookie('userId', '', time() - 60*60*24*30, '/');
        setcookie('login', '', time() - 60*60*24*30, '/');
        setcookie('password', '', time() - 60*60*24*30, '/');
    }

    public static function checkUserCookies() {
        $user = DB::getRow("SELECT * FROM users WHERE login = '" . @$_COOKIE['login'] . "' AND id = '" . @$_COOKIE['userId'] . "'");
        if ($user) {
            if ($user['password'] == @$_COOKIE['password']) {
                return true;
            }else {
                return false;
            }
        }else {
            return false;
        }
    }
}