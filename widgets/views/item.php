<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

/* @var $items \app\modules\product\models\Product */

$first = true;
?>



<?php foreach ($items as $item): ?>
    <div class="item">
        <div class="block-4 text-center">
            <figure class="block-4-image">
                <?php foreach ($item->photoProduct as $photo): ?>
                    <?php if ($first): ?>
                        <img src="<?= $photo->img ?>" alt="Image placeholder" class="img-fluid">
                        <?php $first = false ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </figure>
            <div class="block-4-text p-4">
                <h3><?= Html::a("$item->name", "site/single?id=$item->id") ?></h3>
                <!--                <p class="mb-0">Finding perfect t-shirt</p>-->
                <p class="text-primary font-weight-bold"><?= $item->price ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>










