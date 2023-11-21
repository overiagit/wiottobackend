<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_town_region".
 *
 * @property int $id
 * @property int $town_id
 * @property string $name
 */
class TownRegion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_town_region';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db1');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'town_id', 'name'], 'required'],
            [['id', 'town_id'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'town_id' => 'Town ID',
            'name' => 'Name',
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()
            ->innerJoin('t_town', 't_town_region.town_id = t_town.id' )
            ->where(['t_town.country_id'=>582])->select('t_town_region.id as id, t_town_region.name as name')->all(), 'id', 'name');
    }

    public static function getListByCountry($country_id)
    {
        return ArrayHelper::map(self::find()
            ->innerJoin('t_town', 't_town_region.town_id = t_town.id' )
            ->where(['t_town.country_id'=>$country_id])->select('t_town_region.id as id, t_town_region.name as name')->all(), 'id', 'name');
    }
}
