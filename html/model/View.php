<?php
/**
 * Render
 * Класс предназначен для объединения представления и данных, а так же последующего вывода их
 */
class View
{
    public $view; // Ссылка до view
    public $data; // data, обычно массив данных для view

    public static function render($view, $data)
    {
        include $_SERVER["DOCUMENT_ROOT"] . $view;
    }

    public static function renderEach($view, $data)
    {
        foreach ($data as $object) {
            include $_SERVER["DOCUMENT_ROOT"] . $view;
        }
    }


}

?>