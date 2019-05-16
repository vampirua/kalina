<?php
/**
 * @var $product  app\modules\variant\models\Variant;
 * @var $_params ShoppingCart  :
 */


use yii\helpers\Html;

use yz\shoppingcart\ShoppingCart;

?>
<?php foreach ($model as $product) : ?>


    <tr>
        <td class="product-thumbnail">
            <img src="<?= $product->variant_photo ?>" alt="Image placeholder" class="img-fluid">
        </td>


        <td class="product-name">
            <h2 class="h5 text-black"><?= $product->product->name ?></h2>
        </td>
        <td><?= $product->price ?></td>

        <td>
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

        </td>
        <td><?= $product->price ?></td>
        <td><?= Html::a('X', "/site/delete?id=$product->id", ['class' => 'btn btn-primary btn-sm']) ?></td>
    </tr>
<?php endforeach; ?>