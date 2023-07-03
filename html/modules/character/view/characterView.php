<div class="container">
    <h1><?=$data->name?></h1>
    <?php if (is_array($data->custom_fields)): foreach ($data->custom_fields as $key => $custom_field):?>
        <h2 class="block_name" data-id="<?= $custom_field['header_id'] ?>"><?=$key?></h2>
        <div id="<?=$custom_field['header_id']?>">
            <?php foreach ($custom_field as $value): if (is_array($value)): ?>
                    <dl>
                        <dt>
                            <?=$value['name']?>
                        </dt>
                        <dd><?=$value['data']?></dd>
                    </dl>
            <?php endif;  endforeach; ?>
        </div>
    <?php endforeach; endif; ?>
</div>
<?php
//dd($data)
?>