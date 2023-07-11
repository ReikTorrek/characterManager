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
                    <span>4</span>
                    <span>6</span>
                    <span>8</span>
                    <span>10</span>
                    <span>12</span>
                    <span>20</span>
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