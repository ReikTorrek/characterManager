<div class="row mw-100">
    <?php if (is_array($data['active_characters'])) foreach ($data['active_characters'] as $key => $char): ?>
        <div class="col-sm-3 ml-5 mb-3" id="<?= $char->id ?>">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/static/img/templates/characterTemplate.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $char->name ?></h5>
                    <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                    <a href="/character/<?= $char->id ?>" class="btn btn-primary">Открыть</a>
                    <button class="btn btn-success ml-4 exportBtn" data-id="<?= $char->id ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                            <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>