<?php

use app\modules\statusproduct\models\StatusProduct;
use app\modules\vendor\models\Vendor;
use nullref\category\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'min_quantity')->textInput() ?>


    <?= $form->field($model, 'material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php
    $vendor = vendor::find()->all();
    $vendor_items = ArrayHelper::map($vendor, 'id', 'country')
    ?>
    <?= $form->field($model, 'vendor_id')->dropDownList($vendor_items) ?>
    <?php
    $category = category::find()->all();
    $items = ArrayHelper::map($category, 'id', 'title')
    ?>
    <?= $form->field($model, 'category_id')->dropDownList($items) ?>

    <?php
    $status = Statusproduct::find()->all();
    $status_items = ArrayHelper::map($status, 'id', 'status')
    ?>
    <?= $form->field($model, 'status_product_id')->dropDownList($status_items) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
