<?php


namespace app\widgets;


use app\modules\product\models\Product;
use yii\bootstrap\Widget;


class Item extends Widget
{

    public function run()
    {

        $items = Product::find()->limit(10)->with('photoProduct')->all();
        return $this->render('item', [
            'items' => $items
        ]);

    }
}
