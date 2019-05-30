<?php

namespace app\modules\product\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    public $max_price;
    public $min_price;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code', 'min_quantity', 'vendor_id', 'category_id', 'status_product_id', 'max_price', 'min_price'], 'integer'],
            [['name', 'material', 'description'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'code' => $this->code,
            'min_quantity' => $this->min_quantity,
            'vendor_id' => $this->vendor_id,
            'category_id' => $this->category_id,
            'status_product_id' => $this->status_product_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'material', $this->material])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}

$query->find()->select([
    'minvalue' => new \yii\db\Expression('MIN(table_name.price)'),
    'maxvalue' => new \yii\db\Expression('MAX(table_name.price)'),
])->all();