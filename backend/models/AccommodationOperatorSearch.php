<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccommodationOperator;

/**
 * AccommodationOperatorSearch represents the model behind the search form of `backend\models\AccommodationOperator`.
 * @property string|null $wiotto_hotel_name
 */
class AccommodationOperatorSearch extends AccommodationOperator
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hotel_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = AccommodationOperator::find();

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
            'hotel_id' => $this->hotel_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
//        $query->andFilterWhere(['like', 'wiotto_hotel_name', $this->wiotto_hotel_name]);

        return $dataProvider;
    }
}
