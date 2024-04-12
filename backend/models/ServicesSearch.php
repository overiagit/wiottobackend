<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Services;

/**
 * ServicesSearch represents the model behind the search form of `backend\models\Services`.
 */
class ServicesSearch extends Services
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'supplierOperatorServiceTypeId', 'minimumPax', 'maximumPax', 'isInactive', 'room_type_id'
                , 'hotel_id' ,'accommodation_operator_id'], 'integer'],
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
        $query = Services::find();

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

        $query->innerJoin('supplieroperatorservicetype', 'services.supplierOperatorServiceTypeId = supplieroperatorservicetype.id');
        $query->where('supplieroperatorservicetype.serviceType=7');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'supplierOperatorServiceTypeId' => $this->supplierOperatorServiceTypeId,
            'minimumPax' => $this->minimumPax,
            'maximumPax' => $this->maximumPax,
            'isInactive' => $this->isInactive,
            'room_type_id' => $this->room_type_id,
            'hotel_id' => $this->hotel_id,
//            'accommodation_operator_id' => $this->accommodation_operator_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
