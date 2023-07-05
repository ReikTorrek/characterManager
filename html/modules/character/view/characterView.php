<div class="container">
    <h1><?=$data->name?></h1>
    <?php if (is_array($data->custom_fields)): foreach ($data->custom_fields as $key => $custom_field):?>
        <h2 class="block_name" style="color: <?= $custom_field['color'] ?>" data-id="<?= $custom_field['header_id'] ?>"><?=$key?></h2>
        <div id="<?=$custom_field['header_id']?>">
            <?php foreach ($custom_field as $value): if (is_array($value)): ?>
<!--                    <dl>
                        <dt style="color: <?php /*=$value['color']*/?>">
                            <?php /*=$value['name']*/?>
                        </dt>
                        <dd style="color: <?php /*=$value['data_color']*/?>"><?php /*=$value['data']*/?></dd>
                    </dl>-->
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