<?php
$data = new Character($url_explode[1]);
$data->getAllCustomFields();
View::render("/modules/character/view/characterView.php", $data);