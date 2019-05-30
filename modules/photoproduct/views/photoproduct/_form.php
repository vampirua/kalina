<?php

use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\product\models\Product;

/* @var $this yii\web\View */
/* @var $model app\modules\photoproduct\models\PhotoProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $vendor = Product::find()->all();
    $items = ArrayHelper::map($vendor, 'id', 'name')
    ?>

    <?= $form->field($model, 'product_id')->dropDownList($items) ?>

    <?php echo $form->field($model, 'img')->widget(InputFile::className(), [
        'language' => 'ru',
        'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        'filter' => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
        'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options' => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
        'multiple' => true       // возможность выбора нескольких файлов
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
