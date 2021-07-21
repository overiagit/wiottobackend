<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_uni_hotel_type".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $stars
 * @property int|null $hotel_type_id
 */
class UniHotelStar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_uni_hotel_type';
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
            [['id', 'stars', 'hotel_type_id'], 'integer'],
            [['title'], 'string', 'max' => 45],
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
            'title' => 'Title',
            'stars' => 'Stars',
            'hotel_type_id' => 'Hotel Type ID',
        ];
    }

    public static function getStarList()
    {
        return ArrayHelper::map(self::find()->select('id, title')->all(), 'id', 'title');
    }
}
