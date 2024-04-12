<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AccommodationOperator;

/**
 * AccommodationOperatorSearch represents the model behind the search form of `backend\models\AccommodationOperator`.
 * @property string|null $wiotto_hotel_name
 * @property int|null $supplierOperatorServiceTypeId
 */
class AccommodationOperatorSearch extends AccommodationOperator
{
  public  $supplierOperatorServiceTypeId;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hotel_id','supplierOperatorServiceTypeId'], 'integer'],
            [['name','supplierOperatorServiceTypeId'], 'safe'],
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
        $query->innerJoin('supplieroperatorservicetype'
            , 'accommodation_operator.id = supplieroperatorservicetype.supplierServiceOperatorId');

        $query->select(['accommodation_operator.id as id','accommodation_operator.name as name','accommodation_operator.hotel_id as hotel_id'
                       , 'supplieroperatorservicetype.id as supplierOperatorServiceTypeId'
             ]);

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
            'supplierOperatorServiceTypeId'=>$this->supplierOperatorServiceTypeId,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
//        $query->andFilterWhere(['like', 'wiotto_hotel_name', $this->wiotto_hotel_name]);

        return $dataProvider;
    }
}
