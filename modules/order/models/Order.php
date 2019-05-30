<?php

namespace app\modules\order\models;


use app\modules\position\models\Position;
use app\modules\statusorder\models\StatusOrder;
use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $time
 * @property string $comments
 * @property int $user_id
 * @property int $status_order_id
 *
 * @property StatusOrder $statusOrder
 * @property Position[] $positions
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time'], 'safe'],
            [['user_id', 'status_order_id'], 'integer'],
            [['comments'], 'string', 'max' => 255],
            [['status_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusOrder::className(), 'targetAttribute' => ['status_order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'comments' => 'Comments',
            'user_id' => 'User ID',
            'status_order_id' => 'Status Order ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusOrder()
    {
        return $this->hasOne(StatusOrder::className(), ['id' => 'status_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPositions()
    {
        return $this->hasMany(Position::className(), ['order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }
}
