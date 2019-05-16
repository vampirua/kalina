<?php


namespace app\widgets;


use app\modules\photoproduct\models\PhotoProduct;
use yii\jui\Widget;

class PhotoSlider extends Widget
{
    public $id;

    public function run()
    {
        $photos = PhotoProduct::find()->where(['product_id' => $this->id])->all();

        return $this->render('photo', [
            'photos' => $photos
        ]);

    }
}