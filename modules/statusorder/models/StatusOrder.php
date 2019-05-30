<?php

namespace app\modules\statusorder\models;

use app\modules\order\models\Order;
use Yii;

/**
 * This is the model class for table "status_order".
 *
 * @property int $id
 * @property string $status
 *
 * @property Order[] $orders
 */
class StatusOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_order';
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
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['status_order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return StatusOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatusOrderQuery(get_called_class());
    }
}
