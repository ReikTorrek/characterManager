<?php
if ($user = User::getUserByLogin($_POST['login'])) {
    if ($user->password == Helper::md5_this($_POST['password'])) {
        $user->addUserCoockies();
        header("Location: http://my.character_manager.com/");
    } else {
        header("Location: http://my.character_manager.com/sign_in/?pwd_error=1");
    }
}else {
    header("Location: http://my.character_manager.com/sign_in/?login_error=1");
}