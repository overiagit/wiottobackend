<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Hotel;

/**
 * HotelSearch represents the model behind the search form of `backend\models\Hotel`.
 */
class HotelSearch extends Hotel
{
    /**
     * {@inheritdoc}
     */

    public  $images;

    public function rules()
    {
        return [
            [['id', 'type_id', 'town_id', 'town_region_id', 'location_id', 'country_id', 'island_id'], 'integer'],
            [['name', 'comment', 'note', 'condition' , 'images'], 'safe'],
            [['latitude', 'longitude'], 'number'],
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
        $query = Hotel::find()->where(['country_id'=>582]);

        // add conditions that should always apply here

        $query->leftJoin('wiotto_uni_db.fe_HotelsImages'
            , 't_hotel.id = wiotto_uni_db.fe_HotelsImages.hotel_id' );


        $query->select(['t_hotel.id','t_hotel.type_id'
            ,'t_hotel.town_id','t_hotel.town_region_id','t_hotel.location_id','t_hotel.country_id'
            ,'t_hotel.island_id','t_hotel.name','t_hotel.note','t_hotel.condition'
            ,'t_hotel.latitude','t_hotel.longitude'
            , 'ifnull(GROUP_CONCAT(DISTINCT wiotto_uni_db.fe_HotelsImages.id),"no") as images'
        ]);

        $query->groupBy(['t_hotel.id','t_hotel.type_id'
            ,'t_hotel.town_id','t_hotel.town_region_id','t_hotel.location_id','t_hotel.country_id'
            ,'t_hotel.island_id','t_hotel.name','t_hotel.note','t_hotel.condition'
            ,'t_hotel.latitude','t_hotel.longitude']);


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
            'type_id' => $this->type_id,
            'town_id' => $this->town_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'town_region_id' => $this->town_region_id,
            'location_id' => $this->location_id,
            'country_id' => $this->country_id,
            'island_id' => $this->island_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'condition', $this->condition])
//            ->andFilterWhere(['like', 'images', $this->images])
        ;
        $query->andFilterHaving(['like' , 'ifnull(GROUP_CONCAT(DISTINCT wiotto_uni_db.fe_HotelsImages.id),"no")', $this->images]);
        return $dataProvider;
    }
}
