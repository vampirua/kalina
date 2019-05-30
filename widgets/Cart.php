<?php


namespace app\widgets;


use app\modules\product\models\Product;
use Yii;
use yii\bootstrap\Widget;

class Cart extends Widget
{
    public function run()
    {
        $model = Yii::$app->cart->getPositions();
        return $this->render('cart', ['model' => $model]);

    }

}