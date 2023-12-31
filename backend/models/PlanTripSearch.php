<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HotelSearch represents the model behind the search form of `backend\models\Hotel`.
 */
class PlanTripSearch extends PlanTrip
{
    /**
     * {@inheritdoc}
     */


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
     */ public function search($params)
{
    $query = PlanTrip::find();

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
        'note' => $this->description,
        'country_id' => $this->country_id,
        'active' => $this->active,
    ]);
    return $dataProvider;
}
}
