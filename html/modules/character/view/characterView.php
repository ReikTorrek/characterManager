<div class="container">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary fixed-button" id="togglePanelBtn"><</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel" id="myPanel">
                <div class="dice-icons">
                    <div class="dice-icon" data-dice="4">
                        <span>4</span>
                        <div id="dice-summ-4" data-dice="4">
                            <span>0</span>
                        </div>
                    </div>
                    <div class="dice-icon" data-dice="6">
                        <span>6</span>
                        <div id="dice-summ-6" data-dice="6">
                            <span>0</span>
                        </div>
                    </div>
                    <div class="dice-icon" data-dice="8">
                        <span>8</span>
                        <div id="dice-summ-8" data-dice="8">
                            <span>0</span>
                        </div>
                    </div>
                    <div class="dice-icon" data-dice="10">
                        <span>10</span>
                        <div id="dice-summ-10" data-dice="10">
                            <span>0</span>
                        </div>
                    </div>
                    <div class="dice-icon" data-dice="12">
                        <span>12</span>
                        <div id="dice-summ-12" data-dice="12">
                            <span>0</span>
                        </div>
                    </div>
                    <div class="dice-icon" data-dice="20">
                        <span>20</span>
                        <div id="dice-summ-20" data-dice="20">
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-danger mt-2" id="clearBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <h1><?=$data->name?></h1>
    <?php if (is_array($data->custom_fields)): foreach ($data->custom_fields as $key => $custom_field):?>
        <h2 class="block_name" style="color: <?= $custom_field['color'] ?>" data-id="<?= $custom_field['header_id'] ?>"><?=$key?></h2>
        <div id="<?=$custom_field['header_id']?>">
            <?php foreach ($custom_field as $value): if (is_array($value)): ?>
            <p>
                <span style="color: <?=$value['color']?>"><?=$value['name']?>: </span>
                <span style="color: <?=$value['data_color']?>"><?=$value['data']?></span>
            </p>
            <?php endif;  endforeach; ?>
        </div>
    <?php endforeach; endif; ?>
</div>
<?php
//dd($data)
?>