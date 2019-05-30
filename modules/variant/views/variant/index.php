<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VariantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Variants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Variant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'variant_photo',
            'size',
            'color_id',
            'amount',
            //'product_id',
            //'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
