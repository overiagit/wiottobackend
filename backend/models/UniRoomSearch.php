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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'room_type_id', 'hotel_uni_id', 'hotel_id'], 'integer'],
            [['title', 'description', 'date_add', 'wiotto_name'], 'safe'],
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
            ,'t_uni_room_type.room_type_id as room_type_id','t_uni_room_type.hotel_uni_id as hotel_uni_id'
            ,'t_uni_room_type.hotel_id as hotel_id','t_uni_room_type.description as description'
            ,'t_uni_room_type.date_add as date_add','t_room_type.name as wiotto_name']);

        $query->leftJoin('t_room_type', 't_room_type.id = t_uni_room_type.room_type_id' );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'room_type_id' => $this->room_type_id,
            'hotel_uni_id' => $this->hotel_uni_id,
            'hotel_id' => $this->hotel_id,
            'date_add' => $this->date_add,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 't_room_type.name', $this->wiotto_name]);

        return $dataProvider;
    }
}
