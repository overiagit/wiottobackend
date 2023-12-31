<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Hotel;

/**
 * HotelSearch represents the model behind the search form of `backend\models\Hotel`.
 */
class BestForYouSearch extends BestForYou
{
    /**
     * {@inheritdoc}
     */
    public  $note_ru;
    public  $note_fr;

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
     */ public function search($params)
{
    $query = BestForYou::find();

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

//    $query->leftJoin('fe_best_foryou_lang as lru' , "fe_best_foryou_lang.id=fe_best_for_you.id and lru.lang ='ru' ");
//    $query->leftJoin('fe_best_foryou_lang as lfr' , "fe_best_foryou_lang.id=fe_best_for_you.id and lfr.lang ='fr' ");
//
//    $query->select("fe_best_for_you.id, fe_best_for_you.note, fe_best_for_you.link, fe_best_for_you.row
//                   fe_best_for_you.active , fe_best_for_you.dateadd
//                   , fe_best_for_you.datechange , fe_best_for_you.country_id
//                   , lru.note as note_ru ,  lfr.note as note_fr ");

    // grid filtering conditions
    $query->andFilterWhere([
        'id' => $this->id,
        'note' => $this->description,
//        'country_id' => $this->country_id,
    ]);
    return $dataProvider;
}
}
