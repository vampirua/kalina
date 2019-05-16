<?php
/* @var $model \app\modules\product\models\Product */

use app\assets\AppAsset;
use app\widgets\PhotoSlider;
use yii\helpers\Html;

AppAsset::register($this);

?>


<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><?= Html::a('Home', '/') ?> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black"><?=$model->name?></strong></div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php echo PhotoSlider::widget(['id' => $model->id]) ?>
            </div>
            <div class="col-md-6">
                <h2 class="text-black"><?= $model->name ?></h2>
                <p><?= $model->description ?></p>
                <p><strong class="text-primary h4"><?= $model->price ?></strong></p>
                <?php foreach ($model->variants as $variant): ?>
                    <div class="mb-1 d-flex">
                        <label for="option-sm" class="d-flex mr-3 mb-3">
                        <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                                                                                       id="option-sm"
                                                                                                       name="shop-sizes"></span>
                            <span class="d-inline-block text-black"><?= $variant->size ?></span>
                        </label>

                    </div>
                <?php endforeach; ?>
                <div class="mb-5">
                    <div class="input-group mb-3" style="max-width: 120px;">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                        </div>
                        <input type="text" class="form-control text-center" value="1" placeholder=""
                               aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                        </div>
                    </div>

                </div>


                <p><a href="cart.html" class="buy-now btn btn-sm btn-primary">Add To Cart</a></p>

            </div>
        </div>
    </div>
</div>
