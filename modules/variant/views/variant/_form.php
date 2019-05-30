<?php

use app\modules\color\models\Color;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\product\models\Product;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="variant-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php
    $products = Product::find()->all();
    $product = ArrayHelper::map($products, 'id', 'name')
    ?>
    <?= $form->field($model, 'product_id')->dropDownList($product) ?>

    <?php echo $form->field($model, 'variant_photo')->widget(InputFile::className(), [
        'language' => 'ru',
        'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        'filter' => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
        'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options' => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
        'multiple' => false      // возможность выбора нескольких файлов
    ]);
    ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <?php
    $colors = Color::find()->all();
    $color = ArrayHelper::map($colors, 'id', 'name')
    ?>
    <?= $form->field($model, 'color_id')->dropDownList($color) ?>


    <?= $form->field($model, 'amount')->textInput() ?>


    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
