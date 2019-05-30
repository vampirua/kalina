<?php

use app\modules\statusproduct\models\StatusProduct;
use nullref\category\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\product\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute' => 'name', 'label' => 'Название'],
            ['attribute' => 'price', 'label' => 'Цена'],
            ['attribute' => 'code', 'label' => 'Артикул'],
            ['attribute' => 'min_quantity', 'label' => 'Мин.Заказ Кол-н'],
            ['attribute' => 'vendor_id', 'label' => 'Страна Изготов.'],
            ['attribute' => 'material', 'label' => 'Материал'],

//            [
//                'attribute' => 'category_id',
//                'value' => function ($model) {
//                    return $model->category->title;
//                },
//                'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'title'),
//                'label' => 'Категорія',
//            ],
//            [
//                'attribute' => 'status_product',
//                'value' => function ($model) {
//                    return $model->statusProduct->status;
//                },
//                'filter' => ArrayHelper::map(Statusproduct::find()->all(), 'id', 'status'),
//                'label' => 'Статус'
//            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
