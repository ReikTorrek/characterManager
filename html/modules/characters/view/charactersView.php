    <div class="row mw-100">
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/static/img/templates/characterCreateTemplate.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Создать персонажа</h5>
                    <a href="/create/" class="btn btn-primary">Создать</a>
                </div>
            </div>
        </div>
        <?php foreach ($data as $key => $char): ?>
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/static/img/templates/characterTemplate.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $char->name ?></h5>
                    <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                    <a href="/character/<?= $char->id ?>" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>