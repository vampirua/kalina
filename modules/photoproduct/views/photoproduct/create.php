<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PhotoProduct */

$this->title = 'Create Photo Product';
$this->params['breadcrumbs'][] = ['label' => 'Photo Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
