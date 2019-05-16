<?php

namespace app\modules\color\models;

use app\modules\variant\models\Variant;
use Yii;

/**
 * This is the model class for table "color".
 *
 * @property int $id
 * @property string $name
 * @property string $color
 *
 * @property Variant[] $variants
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'color';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'color' => 'Color',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariants()
    {
        return $this->hasMany(Variant::className(), ['color_id' => 'id']);
    }
}
