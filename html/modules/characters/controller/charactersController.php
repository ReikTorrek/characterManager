<?php
$data = Character::getAllCharacters();
View::render("/modules/characters/view/charactersView.php", $data);