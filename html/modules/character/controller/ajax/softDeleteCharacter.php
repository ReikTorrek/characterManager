<?php
$character = new Character($_POST['characterId']);
$character->softDeleteCharacter();