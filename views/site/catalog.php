<?php

use app\assets\AppAsset;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/**
 * @var $searchModel app\models\Catalog
 * @var $dataProvider ActiveDataProvider
 * @var $filters array
 *
 */
AppAsset::register($this);

?>
<div class="container">
    <div class="category-wrap">
        <div class="row mb-5">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="col-lg-9 order-2">
                <?php Pjax::begin(); ?>

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_list',
                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => 'col-xs-10',
                    ]
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>


</div>
