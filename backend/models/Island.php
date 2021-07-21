<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_island".
 *
 * @property int $id
 * @property int $town_region_id
 * @property string $name
 */
class Island extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_island';
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
            [['id', 'town_region_id', 'name'], 'required'],
            [['id', 'town_region_id'], 'integer'],
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
            'town_region_id' => 'Town Region ID',
            'name' => 'Name',
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()
            ->innerJoin('t_town_region', 't_town_region.id = t_island.town_region_id' )
            ->innerJoin('t_town', 't_town_region.town_id = t_town.id' )
            ->where(['t_town.country_id'=>582])->select('t_island.id as id, t_island.name as name')->all(), 'id', 'name');
    }
}
