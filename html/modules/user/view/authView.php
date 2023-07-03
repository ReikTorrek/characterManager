<form method="post" action="/modules/user/controller/authUser.php">
    <div class="mb-3">
        <label for="login" class="form-label">login</label>
        <input type="text" class="form-control <?=@$_GET['login_error'] ? 'border-danger' : ''?>" id="login" name="login">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control <?=@$_GET['pwd_error'] ? 'border-danger' : ''?>" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <?= @$_GET['login_error'] ? '<p class="alert-danger">Логин введён неверно</p>' : ''?>
    <?= @$_GET['pwd_error'] ? '<p class="alert-danger">Пароль введён неверно</p>' : ''?>
</form>