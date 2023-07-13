<div class="container">
    <div class="user-profile">
        <img src="<?=$data['user']->avatar ?>" alt="Фото профиля">
        <h3><?=$data['user']->login ?></h3>
    </div>
    <div class="user-links">
        <a href="/user/deleted/">Удалённые персонажи</a>
        <a href="/user/settings/">Настройки</a>
        <a href="/user/export/">Экспортировать персонажа</a>
        <a href="/user/import/">Импортировать персонажа</a>
    </div>
</div>