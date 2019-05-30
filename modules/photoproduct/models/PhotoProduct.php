<?php

namespace app\modules\photoproduct\models;

use app\modules\product\models\Product;
use Yii;

/**
 * This is the model class for table "photo_product".
 *
 * @property int $id
 * @property string $img
 *
 * @property Product[] $products
 */
class PhotoProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Img',
            'product_id'=> 'Product ID'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['photo_product_id' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     * @return PhotoProductQuery the active query used by this AR class.
     */


    public static function find()
    {
        return new PhotoProductQuery(get_called_class());
    }
}
