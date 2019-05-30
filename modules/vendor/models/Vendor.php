<?php

namespace app\modules\vendor\models;

use app\modules\product\models\Product;
use Yii;

/**
 * This is the model class for table "vendor".
 *
 * @property int $id
 * @property string $country
 *
 * @property Product[] $products
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['vendor_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return VendorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VendorQuery(get_called_class());
    }
}
