<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_uni_resort".
 *
 * @property int $id
 * @property int|null $CountryId
 * @property string|null $TitleEn
 * @property string|null $TitleRu
 * @property int|null $ParentId
 * @property string|null $Longitude
 * @property string|null $Latitude
 */
class UniResort extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_uni_resort';
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
            [['id'], 'required'],
            [['id', 'CountryId', 'ParentId'], 'integer'],
            [['TitleEn', 'TitleRu', 'Longitude', 'Latitude'], 'string', 'max' => 45],
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
            'CountryId' => 'Country ID',
            'TitleEn' => 'Title En',
            'TitleRu' => 'Title Ru',
            'ParentId' => 'Parent ID',
            'Longitude' => 'Longitude',
            'Latitude' => 'Latitude',
        ];
    }
}
