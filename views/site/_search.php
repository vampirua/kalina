<?php

use app\modules\Product\models\Product;
use app\modules\color\models\Color;
use app\modules\variant\models\Variant;
use app\modules\vendor\models\Vendor;
use nullref\category\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Catalog */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="col-md-3 order-1 mb-5 mb-md-0">

    <?php $form = ActiveForm::begin([
        'action' => ['site/catalog'],
        'method' => 'get',
    ]); ?>


    <?php
    $category = category::find()->all();
    $items = ArrayHelper::map($category, 'id', 'title')
    ?>
    <?= $form->field($model, 'category_id')->dropDownList($items, ['prompt' => 'Виберіть категорію'])->label('Категорія') ?>
    <?php
    $vendor = Vendor::find()->all();
    $vendor_items = ArrayHelper::map($vendor, 'id', 'country');
    ?>
    <?= $form->field($model, 'vendor_id')->dropDownList($vendor_items, ['prompt' => 'Виберіть країну'])->label('Виробик') ?>

    <?php
    $size = Variant::find()->all();
    $size_item = ArrayHelper::map($size, 'size', 'size')
    ?>
    <?= $form->field($model, 'size')->dropDownList($size_item, ['prompt' => 'Виберіть розмір'])->label('Розмір') ?>


    <?php
    $color = Color::find()->all();
    $color_items = ArrayHelper::map($color, 'id', 'name');
    ?>
    <?= $form->field($model, 'color_id')->checkboxList($color_items)->label('Колір') ?>


    <?php
    $material = Product::find()->select('material')->all();
    $material_items = ArrayHelper::map($material, 'material', 'material')
    ?>
    <?= $form->field($model, 'material')->checkboxList($material_items)->label('Матеріал') ?>


    <div class="border p-4 rounded mb-4">
<!--        <div class="mb-4">-->
<!--            <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>-->
<!--            <div id="slider-range" class="border-primary"></div>-->
<!--            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white"-->
<!--                   disabled=""/>-->
<!--        </div>-->
        <div class="row">
            <div class="col-xs-10 text-center">Ціна</div>
            <div class="col-xs-5 text-center">   <?= $form->field($model, 'min_price')->label('Мін') ?></div>
            <div class="col-xs-5 text-center">    <?= $form->field($model, 'max_price')->label('Макс') ?></div>
        </div>


        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        </div>


        <?php ActiveForm::end(); ?>

    </div>
