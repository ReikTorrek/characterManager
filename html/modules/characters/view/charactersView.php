<?php foreach ($data as $key => $char): ?>
<div class="card" style="width: 18rem;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <p class="card-text"><?= $char->name ?></p>
    </div>
</div>
<?php endforeach; ?>