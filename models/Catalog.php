<?php


namespace app\models;


use app\modules\product\models\Product;
use app\modules\variant\models\Variant;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class Catalog extends Product
{
    public $size;
    public $color_id;
    public $min_price;
    public $max_price;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'code', 'min_quantity', 'vendor_id', 'category_id', 'min_price', 'max_price'], 'integer'],
            [['name', 'material', 'photo_product', 'size', 'color_id'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied3
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find()->with('variants');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $variantQuery = Variant::find()->with('color')->select(['product_id']);
        if ($this->color_id) {
            $variantQuery->andWhere(['color_id' => $this->color_id]);
        }
        if ($this->size) {
            $variantQuery->andWhere(['size' => $this->size]);
        }


        $productIds = $variantQuery->column();


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $productIds,
            'code' => $this->code,
            'min_quantity' => $this->min_quantity,
            'vendor_id' => $this->vendor_id,
            'category_id' => $this->category_id,

        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'material', $this->material])
            ->andFilterWhere([
                'and',
                ['<', 'price', $this->max_price],
                ['>', 'price', $this->min_price],
            ]);

        return $dataProvider;
    }
}