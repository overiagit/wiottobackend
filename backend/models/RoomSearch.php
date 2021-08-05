<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Room;

/**
 * RoomSearch represents the model behind the search form of `backend\models\Room`.
 */
class RoomSearch extends Room
{

    public  $uni_room_type_ids;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rooms', 'exbeds', 'hotel_id', 'active', 'uni_room_type_id'], 'integer'],
            [['name', 'villa', 'note'], 'safe'],
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
        $query = Room::find();

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

        $query->select(['t_room_type.id','t_room_type.name'
            ,'t_room_type.villa','t_room_type.rooms','t_room_type.exbeds','t_room_type.note'
            ,'ifnull(t_room_type.hotel_id, 0) as hotel_id','t_room_type.active'
            , "ifnull(group_concat(t_uni_room_type.id), 'no') as uni_room_type_ids"]);

        $query->leftJoin('t_uni_room_type', 't_room_type.id = t_uni_room_type.room_type_id' );

        $query->groupBy(['t_room_type.id','t_room_type.name'
            ,'t_room_type.villa','t_room_type.rooms','t_room_type.exbeds','t_room_type.note'
            ,'t_room_type.hotel_id','t_room_type.active']);

        // grid filtering conditions
        $query->andFilterWhere([
            't_room_type.id' => $this->id,
            't_room_type.rooms' => $this->rooms,
            't_room_type.exbeds' => $this->exbeds,
            'ifnull(t_room_type.hotel_id, 0)' => $this->hotel_id,
            't_room_type.active' => $this->active,
//            'uni_room_type_ids' => $this->uni_room_type_ids,
        ]);

        $query->andFilterWhere(['like', 't_room_type.name', $this->name])
            ->andFilterWhere(['like', 't_room_type.villa', $this->villa])
            ->andFilterWhere(['like', 't_room_type.note', $this->note]);

        return $dataProvider;
    }
}
