<?php

/* @var $photos \app\modules\photoproduct\models\PhotoProduct */

use app\assets\AppAsset;

AppAsset::register($this);
?>
<div class="photo-slider owl-carousel">


    <?php foreach ($photos as $photo): ?>
        <div class="item">
            <img src="<?= $photo->img ?>" alt="Image placeholder" class="img-fluid">
        </div>
    <?php endforeach; ?>
</div>
