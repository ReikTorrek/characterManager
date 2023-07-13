<?php
$data = Character::getAllDeletedCharactersByUserId($_COOKIE['userId']);
View::render("/modules/characters/view/deletedCharactersView.php", $data);