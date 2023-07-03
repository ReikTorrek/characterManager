<?php
$data = Character::getAllCharactersByUserId();
View::render("/modules/characters/view/charactersView.php", $data);