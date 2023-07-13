<?php
$data['user'] = User::getUserByLogin($_COOKIE['login']);
if (!$data['user']->avatar) {
    $data['user']->avatar = '/static/img/templates/characterTemplate.jpg';
}
View::render("/modules/user/view/userView.php", $data);