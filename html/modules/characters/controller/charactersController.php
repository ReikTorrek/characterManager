<?php
$data = Character::getAllCharactersByUserId($_COOKIE['userId']);
View::render("/modules/characters/view/charactersView.php", $data);