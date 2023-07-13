<div class="row mw-100">
    <?php if (is_array($data)) foreach ($data as $key => $char): ?>
        <div class="col-sm-3 ml-5 mb-3" id="<?= $char->id ?>">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/static/img/templates/characterTemplate.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $char->name ?></h5>
                    <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                    <a href="/character/<?= $char->id ?>" class="btn btn-primary">Открыть</a>
                    <button class="btn btn-danger ml-4 clearBtn" data-id="<?= $char->id ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-dizzy-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM4.146 5.146a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 1 1 .708.708l-.647.646.647.646a.5.5 0 1 1-.708.708L5.5 7.207l-.646.647a.5.5 0 1 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 0-.708zm5 0a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 1 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 0-.708zM8 13a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                        </svg>
                    </button>
                    <button class="btn btn-success ml-4 restoreBtn" data-id="<?= $char->id ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (!is_array($data)): ?>
    <h2 style="margin-left: 30%">У вас нет удалённых персонажей. Неплохо...</h2>
    <?php endif; ?>
</div>