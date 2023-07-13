<?php
$data['deleted_characters'] = Character::getAllDeletedCharactersByUserId($_COOKIE['userId']);
$data['active_characters'] = Character::getAllCharactersByUserId($_COOKIE['userId']);
View::render("/modules/characters/view/exportCharacterView.php", $data);