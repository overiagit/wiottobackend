<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UniRoom;

/**
 * UniHotelSearch represents the model behind the search form of `app\models\UniHotel`.
 */
class UniRoomSearch extends UniRoom
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hotel_uni_id', 'hotel_id',  'room_type_id'], 'integer'],
            [['title', 'description',  'date_add'], 'safe'],
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
        $query = UniRoom::find()->where(['hotel_uni_id'=>$this->hotel_uni_id]);

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
            'hotel_uni_id' => $this->hotel_uni_id,
            'room_type_id' => $this->room_type_id,
            'title' => $this->title,
            'description' => $this->description,
            'hotel_id' => $this->hotel_id,
            'date_add' => $this->date_add,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]
//            ->andFilterWhere(['like', 'Longitude', $this->Longitude])
//            ->andFilterWhere(['like', 'Latitude', $this->Latitude]
            );

        return $dataProvider;
    }
}
