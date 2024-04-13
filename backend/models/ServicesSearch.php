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

    public $hotel_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'supplierOperatorServiceTypeId', 'minimumPax', 'maximumPax', 'isInactive', 'room_type_id'
                , 'hotel_id' ,'accommodation_operator_id'], 'integer'],
            [['name', 'hotel_name'], 'safe'],
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
        $query->innerJoin('accommodation_operator', 'services.accommodation_operator_id = accommodation_operator.id');

        $query->where('supplieroperatorservicetype.serviceType=7');
        // grid filtering conditions
        $query->andFilterWhere([
            'services.id' => $this->id,
            'services.supplierOperatorServiceTypeId' => $this->supplierOperatorServiceTypeId,
            'services.minimumPax' => $this->minimumPax,
            'services.maximumPax' => $this->maximumPax,
            'services.isInactive' => $this->isInactive,
            'ifnull(services.room_type_id,0)' => $this->room_type_id,
            'ifnull(services.hotel_id,0)' => $this->hotel_id,
//            'hotel_name' => $this->hotel_name,
            'services.accommodation_operator_id' => $this->accommodation_operator_id,
        ]);

        $query->andFilterWhere(['like', 'services.name', $this->name]);
        $query->andFilterWhere(['like', 'accommodation_operator.name', $this->hotel_name]);


        $query->select(['ifnull(services.accommodation_operator_id,0) as accommodation_operator_id','services.id'
            ,'services.name'
            ,'services.minimumPax'
            ,'services.maximumPax'
            ,'services.isInactive'
             ,'ifnull(services.room_type_id,0) as room_type_id'
            ,'ifnull(services.hotel_id,0) as hotel_id'
            ,'accommodation_operator.name as hotel_name'
            ,'services.date_add','services.date_upd'
        ]);

        return $dataProvider;
    }
}
