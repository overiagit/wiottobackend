<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UniHotel;

/**
 * UniHotelSearch represents the model behind the search form of `app\models\UniHotel`.
 */
class UniHotelSearch extends UniHotel
{
    /**
     * {@inheritdoc}
     */

    public $wiotto_hotel_name;

    public function rules()
    {
        return [
            [['id', 'starId', 'ResortId', 'CountryId', 'hotel_id'], 'integer'],
            [['title', 'Longitude', 'Latitude', 'date_add', 'wiotto_hotel_name'], 'safe'],
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
        $query = UniHotel::find();

        // add conditions that should always apply here

        $query->select(['t_uni_hotel.id as id','t_uni_hotel.starId as starId','t_uni_hotel.title as title'
            , 't_uni_hotel.ResortId as ResortId', 't_uni_hotel.CountryId as CountryId'
            ,'ifnull(t_uni_hotel.hotel_id,0) as hotel_id','t_uni_hotel.date_add as date_add', 't_hotel.name  as wiotto_hotel_name' ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->leftJoin('t_hotel', 't_hotel.id = t_uni_hotel.hotel_id' );

        // grid filtering conditions
        $query->andFilterWhere([
            't_uni_hotel.id' => $this->id,
            't_uni_hotel.starId' => $this->starId,
            't_uni_hotel.ResortId' => $this->ResortId,
            't_uni_hotel.CountryId' => $this->CountryId,
            'ifnull(t_uni_hotel.hotel_id,0)' => $this->hotel_id,
            't_uni_hotel.date_add' => $this->date_add,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
              ->andFilterWhere(['like', 't_hotel.name', $this->wiotto_hotel_name]);
//            ->andFilterWhere(['like', 'Longitude', $this->Longitude])
//            ->andFilterWhere(['like', 'Latitude', $this->Latitude])
        ;

        return $dataProvider;
    }
}
