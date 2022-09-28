<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Coupon;

/**
 * CouponSearch represents the model behind the search form of `backend\models\Coupon`.
 */
class CouponSearch extends Coupon
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'percent', 'active'], 'integer'],
            [['name', 'note', 'date_from', 'date_to','description', 'price_from', 'price_to','order'], 'safe'],
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
        $query = Coupon::find();

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
            'percent' => $this->percent,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'active' => $this->active,
            'order' => $this->order,
            'price_from' => $this->price_from,
            'price_to' => $this->price_to,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->note])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
