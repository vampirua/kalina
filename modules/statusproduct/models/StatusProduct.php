<?php

namespace app\modules\statusproduct\models;

use app\modules\product\models\Product;
use Yii;

/**
 * This is the model class for table "status_product".
 *
 * @property int $id
 * @property string $status
 *
 * @property Product[] $products
 */
class StatusProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['status_product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return StatusProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatusProductQuery(get_called_class());
    }
}
