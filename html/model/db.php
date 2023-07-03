<?php

class DB
{
    public static $dsn = 'mysql:host=db;dbname=local'; // Коннект
    public static $user = 'local'; // Логин
    public static $pass = 'local'; // Пароль
    public static $dbh = null; // Объект PDO.
    public static $sth = null; // Statement Handle.
    public static $query = ''; // Запрос


    // Подключение к БД
    public static function getDbh()
    {
        if (!self::$dbh) {
            try {
                self::$dbh = new PDO(
                    self::$dsn,
                    self::$user,
                    self::$pass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
                );
                self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            } catch (PDOException $e) {
                exit('Ошибка подключения к БД: ' . $e->getMessage());
            }
        }

        return self::$dbh;
    }

    /**
     * Добавление в таблицу, в случаи успеха вернет вставленный ID, иначе 0.
     */
    /*
    $addArray = array(
        'id' => 17,
        'foo' => 'bar'
    );
    $reutrnId = DB::add("INSERT INTO table (id, foo) VALUES (:id, :foo)", $addArray);
    return $reutrnId;
    */
    public static function add($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        return (self::$sth->execute((array) $param)) ? self::getDbh()->lastInsertId() : 0;
    }

    /**
     * Выполнение запроса.
     */
    /*
        $array = array(
            'id' => 17,
            'foo' => 'bar'
        );
        $item = DB::set("DELETE/UPDATE query");
    */
    public static function set($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        return self::$sth->execute((array) $param);
    }

    /**
     * Получение строки из таблицы.
     */
    /*
    ---------------------------------------------------------------
        $array = array(
            'id' => 17,
            'foo' => 'bar'
        );
        $item = DB::getRow("SELECT * FROM tablename WHERE id = ?", 17);
        OR
        $item = DB::getRow("SELECT * FROM tablename WHERE
        `id` = :id,
        `foo` = :foo",
        $array);
    ---------------------------------------------------------------
    */
    public static function getRow($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute((array) $param);
        return self::$sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Получение всех строк из таблицы.
     */
    /*
    ---------------------------------------------------------------
        $array = array(
            'id' => 17,
            'foo' => 'bar'
        );
        $item = DB::getAll("SELECT * FROM tablename WHERE id = ?", 17);
        OR
        $item = DB::getAll("SELECT * FROM tablename WHERE
        `id` = :id,
        `foo` = :foo",
        $array);
    ---------------------------------------------------------------
    */
    public static function getAll($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute((array) $param);
        return self::$sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Получение значения.
     */
    /*
    ---------------------------------------------------------------
        $array = array(
            'id' => 17,
            'foo' => 'bar'
        );
        $item = DB::getValue("SELECT param FROM tablename WHERE id = ?", 17);
        OR
        $item = DB::getValue("SELECT param FROM tablename WHERE
        `id` = :id,
        `foo` = :foo",
        $array);
    ---------------------------------------------------------------
    */
    public static function getValue($query, $param = array(), $default = null)
    {
        $result = self::getRow($query, $param);
        if (!empty($result)) {
            $result = array_shift($result);
        }

        return (empty($result)) ? $default : $result;
    }

    /**
     * Получение столбца таблицы.
     */
    public static function getColumn($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute((array) $param);
        return self::$sth->fetchAll(PDO::FETCH_COLUMN);
    }
}


?>
