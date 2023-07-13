<div class="container">
    <h1><?=$data->name?></h1>
    <?php if (is_array($data->custom_fields)): foreach ($data->custom_fields as $key => $custom_field): ?>
        <h2 class="block_name" style="color: <?= $custom_field['color'] ?>" data-id="<?= $custom_field['id'] ?>"><?=$custom_field['name']; ?></h2>
        <div id="<?=$custom_field['id']?>">
            <?php if (is_array($custom_field['children']))  foreach ($custom_field['children'] as $headerChild): if (is_array($headerChild)): ?>
            <div class="ml-3 mb-2 field">
                <span style="color: <?=$headerChild['color']?>" class="field_name" data-header="<?=$custom_field['id']?>" data-id="<?=$headerChild['id']?>"><?=$headerChild['name']?></span>
                <span style="color: <?=$headerChild['data_color']?>" class="field_value" data-header="<?=$custom_field['id']?>" data-id="<?=$headerChild['id']?>"><?=$headerChild['data']?></span>
                <?php foreach ($headerChild['children'] as $child): ?>
                    <div class="child">
                        <span class="ml-3 child_name" style="color: <?=$child['color']?>" data-id="<?=$child['id']?>"><?= $child['name'] ?> </span>
                        <span class="child_value" style="color: <?=$child['data_color']?>" data-id="<?=$child['id']?>"><?= $child['data'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif;  endforeach; ?>
        </div>
    <?php endforeach; endif; ?>
</div>
<?php
//dd($data)
?>