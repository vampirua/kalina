<?php

namespace app\modules\product\models;


use app\modules\favorite\models\Favorite;
use app\modules\photoproduct\models\PhotoProduct;
use app\modules\statusproduct\models\StatusProduct;
use app\modules\variant\models\Variant;
use app\modules\vendor\models\Vendor;
use nullref\category\models\Category;
use Yii;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property double $price
 * @property int $code
 * @property int $min_quantity
 * @property int $vendor_id
 * @property string $material
 * @property string $description
 * @property int $category_id
 * @property int $photo_product_id
 * @property int $status_product_id
 *
 * @property Favorite $favorite
 * @property Category $category
 * @property PhotoProduct $photoProduct
 * @property StatusProduct $statusProduct
 * @property Vendor $vendor
 * @property Variant[] $variants
 */
class Product extends \yii\db\ActiveRecord implements CartPositionInterface
{

    use CartPositionTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['code', 'min_quantity', 'vendor_id', 'category_id',  'status_product_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'material'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],

            [['status_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusProduct::className(), 'targetAttribute' => ['status_product_id' => 'id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['vendor_id' => 'id']],
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
            'price' => 'Price',
            'code' => 'Code',
            'min_quantity' => 'Min Quantity',
            'vendor_id' => 'Vendor ID',
            'material' => 'Material',
            'description' => 'Description',
            'category_id' => 'Category ID',

            'status_product_id' => 'Status Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorite()
    {
        return $this->hasOne(Favorite::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoProduct()
    {
        return $this->hasMany(PhotoProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusProduct()
    {
        return $this->hasOne(StatusProduct::className(), ['id' => 'status_product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(Vendor::className(), ['id' => 'vendor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariants()
    {
        return $this->hasMany(Variant::className(), ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
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
