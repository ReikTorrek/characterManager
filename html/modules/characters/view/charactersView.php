    <div class="row mw-100">
        <div class="col-sm-3 ml-5 mb-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/static/img/templates/characterCreateTemplate.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Создать персонажа</h5>
                    <a href="/create/" class="btn btn-primary">Создать</a>
                </div>
            </div>
        </div>
        <?php foreach ($data as $key => $char): ?>
        <div class="col-sm-3 ml-5 mb-3" id="<?= $char->id ?>">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/static/img/templates/characterTemplate.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $char->name ?></h5>
                    <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                    <a href="/character/<?= $char->id ?>" class="btn btn-primary">Открыть</a>
                    <button class="btn btn-danger ml-5 clearBtn" data-id="<?= $char->id ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>