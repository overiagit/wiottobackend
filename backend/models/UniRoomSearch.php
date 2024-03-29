<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UniRoom;

/**
 * UniRoomSearch represents the model behind the search form of `backend\models\UniRoom`.
 */
class UniRoomSearch extends UniRoom
{

    public $wiotto_name;
    public $uni_hotel;
    public $CountryId;
    public $not_like;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'room_type_id', 'hotel_uni_id', 'hotel_id'], 'integer'],
            [['title', 'description', 'date_add', 'wiotto_name', 'uni_hotel','CountryId' , 'not_like'], 'safe'],
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
        $query = UniRoom::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->select(['t_uni_room_type.id as id','t_uni_room_type.title as title'
            ,'ifnull(t_uni_room_type.room_type_id,0) as room_type_id'
            ,'t_uni_room_type.hotel_uni_id as hotel_uni_id'
            ,'t_uni_hotel.title as uni_hotel','t_uni_hotel.CountryId  as CountryId'
            ,'t_uni_room_type.hotel_id as hotel_id','t_uni_room_type.description as description'
            ,'t_uni_room_type.date_add as date_add','t_room_type.name as wiotto_name'
            ,'t_uni_room_type.maxpax as maxpax','t_uni_room_type.parent as parent'

        ]);
        $query->innerJoin('t_uni_hotel', 't_uni_hotel.id = t_uni_room_type.hotel_uni_id' );
        $query->leftJoin('t_room_type', 't_room_type.id = t_uni_room_type.room_type_id' );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            't_uni_room_type.id' => $this->id,
            'ifnull(t_uni_room_type.room_type_id,0)' => $this->room_type_id,
            't_uni_room_type.hotel_uni_id' => $this->hotel_uni_id,
            't_uni_room_type.hotel_id' => $this->hotel_id,
            't_uni_room_type.date_add' => $this->date_add,
            't_uni_hotel.CountryId' => $this->CountryId,
        ]);

        $query->andFilterWhere(['like', 't_uni_room_type.title', $this->title])
            ->andFilterWhere(['like', 't_uni_room_type.description', $this->description])
            ->andFilterWhere(['like', 't_room_type.name', $this->wiotto_name])
            ->andFilterWhere(['like', 't_uni_hotel.title', $this->uni_hotel]);


        if(($this->not_like == 1))
        $query->andFilterWhere(['not like', 't_uni_room_type.title', "1N "])
            ->andFilterWhere(['not like', 't_uni_room_type.title', "2N "])
            ->andFilterWhere(['not like', 't_uni_room_type.title', "3N "])
            ->andFilterWhere(['not like', 't_uni_room_type.title', "4N "]);


        return $dataProvider;
    }
}
