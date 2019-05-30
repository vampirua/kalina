<?php

namespace app\modules\position\models;

use app\modules\order\models\Order;
use app\modules\variant\models\Variant;
use Yii;

/**
 * This is the model class for table "position".
 *
 * @property int $id
 * @property int $amount
 * @property double $price
 * @property int $variant_id
 * @property int $order_id
 *
 * @property Order $order
 * @property Variant $variant
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'variant_id', 'order_id'], 'integer'],
            [['price'], 'number'],
            [['variant_id'], 'unique'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['variant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Variant::className(), 'targetAttribute' => ['variant_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'price' => 'Price',
            'variant_id' => 'Variant ID',
            'order_id' => 'Order ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariant()
    {
        return $this->hasOne(Variant::className(), ['id' => 'variant_id']);
    }

    /**
     * {@inheritdoc}
     * @return PositionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PositionQuery(get_called_class());
    }
}
