<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Option;
/**
 * OptionSearch represents the model behind the search form of `backend\models\Option`.
 * @property string|null $group_name
 */
class OptionSearch extends Option
{

    public $group_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'show','show_list', 'uni_id', 'country_id', 'group_id'], 'integer'],
            [['name', 'tourplan_code', 'group_name'], 'safe'],
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
        $query = Option::find()->where(['type'=>[0]]);

        $query->leftJoin('wiotto_db.t_option_group'
            , 't_option.group_id = wiotto_db.t_option_group.id' );

        $query->select(['t_option.id','t_option.group_id'
            ,'t_option.type','t_option.name','t_option.show','t_option.show_list','t_option.uni_id'
            ,'t_option.tourplan_code','t_option.country_id','t_option_group.name as group_name'
        ]);

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
            'type' => $this->type,
            'show' => $this->show,
            'show_list' => $this->show_list,
            'uni_id' => $this->uni_id,
            'country_id' => $this->country_id,
            'group_id' => $this->group_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'tourplan_code', $this->tourplan_code])
            ->andFilterWhere(['like', 't_option_group.name', $this->group_name]);

        return $dataProvider;
    }
}
