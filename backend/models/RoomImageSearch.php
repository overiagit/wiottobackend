<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RoomImage;

/**
 * RoomImageSearch represents the model behind the search form of `backend\models\RoomImage`.
 */
class RoomImageSearch extends RoomImage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hotel_id', 'room_id', 'isMain', 'orderNr'], 'integer'],
            [['title', 'description', 'path'], 'safe'],
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
        $query = RoomImage::find();

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
            'room_id' => $this->room_id,
            'isMain' => $this->isMain,
            'orderNr' => $this->orderNr,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
