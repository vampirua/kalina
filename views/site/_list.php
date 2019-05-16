<?php
/**
 * Created by PhpStorm.
 * User: Dimon
 * Date: 14.05.2018
 * Time: 13:53
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */
$first = true;
?>

<div class="item container_index float-left">

    <div class="img-product">
        <?php foreach ($model->photoProduct as $photo): ?>
            <?php if ($first): ?>
                <img src="<?= $photo->img ?>" alt="Image placeholder" class="img-fluid">
                <?php $first = false ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div>
        <span>Цена</span>
        <span> <?= Html::encode($model->price) ?></span>

    </div>
    <div>
        <span>Производитель</span>
        <span><?= Html::encode($model->vendor_id) ?></span>

    </div>


    <div class="content_variant">
        <div class="more">
            <?= Html::a('Подробние', "/site/main?id=$model->id", ['class' => 'btn-more']) ?>
        </div>
        <div class="add">
            <?php foreach ($model->variants as $variant): ?>
                <?= Html::a('buy', "/site/save?id=$variant->id") ?>
            <?php endforeach; ?>
        </div>
    </div>


</div>