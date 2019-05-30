<?php

namespace app\modules\variant\models;

use app\modules\color\models\Color;
use app\modules\position\models\Position;
use app\modules\product\models\Product;
use Yii;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

/**
 * This is the model class for table "variant".
 *
 * @property int $id
 * @property string $variant_photo
 * @property string $size
 * @property int $color_id
 * @property int $amount
 * @property int $product_id
 * @property double $price
 *
 * @property Position $position
 * @property Color $color
 * @property Product $product
 */
class Variant extends \yii\db\ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color_id', 'amount', 'product_id'], 'integer'],
            [['price'], 'number'],
            [['variant_photo', 'size'], 'string', 'max' => 255],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['color_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'variant_photo' => 'Variant Photo',
            'size' => 'Size',
            'color_id' => 'Color ID',
            'amount' => 'Amount',
            'product_id' => 'Product ID',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['variant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     * @return VariantQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariantQuery(get_called_class());
    }


    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }
}
