<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_town".
 *
 * @property int $id
 * @property int $country_id
 * @property int|null $region_id
 * @property string $name
 * @property string|null $zone
 */
class Town extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_town';
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
            [['id', 'country_id', 'name'], 'required'],
            [['id', 'country_id', 'region_id'], 'integer'],
            [['name', 'zone'], 'string', 'max' => 128],
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
            'country_id' => 'Country ID',
            'region_id' => 'Region ID',
            'name' => 'Name',
            'zone' => 'Zone',
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->where(['country_id'=>582])->select('id, name')->all(), 'id', 'name');
    }

    public static function getListByCountry($country_id)
    {
        return ArrayHelper::map(self::find()->where(['country_id'=>$country_id])->select('id, name')->all(), 'id', 'name');
    }
}
