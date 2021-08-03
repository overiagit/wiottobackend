<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_hotel".
 *
 * @property int $id
 * @property int $type_id
 * @property int $town_id
 * @property string $name
 * @property float|null $latitude
 * @property float|null $longitude
 * @property int|null $town_region_id
 * @property string|null $comment
 * @property string|null $note
 * @property int|null $location_id
 * @property int $country_id
 * @property int|null $island_id
 * @property string|null $condition
 *
 * @property UniHotel[] $UniHotels
// * @property UniRoomType[] $UniRoomType
 */
class Hotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_hotel';
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
            [['id', 'type_id', 'town_id', 'name'], 'required', 'message' => 'Requered filds'],
            [['id', 'type_id', 'town_id', 'town_region_id', 'location_id', 'country_id', 'island_id'], 'integer', 'message' => 'Requered int'],
            [['latitude', 'longitude'], 'number', 'message' => 'Requered number'],
            [['comment', 'note', 'condition'], 'string'],
            [['name'], 'string', 'max' => 128],
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
            'type_id' => 'Type ID',
            'town_id' => 'Town ID',
            'name' => 'Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'town_region_id' => 'Town Region ID',
            'comment' => 'Comment',
            'note' => 'Note',
            'location_id' => 'Location ID',
            'country_id' => 'Country ID',
            'island_id' => 'Island ID',
            'condition' => 'Condition',
        ];
    }


    /**
     * Gets query for [[TUniHotels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUniHotels()
    {
        return $this->hasMany(UniHotel::className(), ['hotel_id' => 'id']);
    }

    /**
     * Gets query for [[TUniRoomType1s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUniRoomType()
    {
        return null;
//        return $this->hasMany(UniRoomType::className(), ['hotel_id' => 'id']);
    }

    public function getHotelName()
    {
        return $this->name;
//        return $this->hasMany(UniRoomType::className(), ['hotel_id' => 'id']);
    }


    public static function getList()
    {
        return ArrayHelper::map(self::find()->select('id, name')->all(), 'id', 'name');
    }

    public static function getHotelDataList()
    {
        return ArrayHelper::map(self::find()
            ->innerJoin('t_hotel_type', 't_hotel.type_id = t_hotel_type.id')
            ->leftJoin('t_town_region', 't_hotel.town_region_id = t_town_region.id')
            ->leftJoin('t_island', 't_hotel.island_id = t_island.id')
            ->select(["`t_hotel`.`id` as `id`"
                , "concat(`t_hotel`.`name`,' ', `t_hotel_type`.`name` 
                 , ifnull( concat(' region:' ,`t_town_region`.`name` ),'') 
                 , ifnull(concat(' island:',`t_island`.`name` ),'')) as `name`"])
            ->orderBy(['`t_hotel`.`name`'=>SORT_ASC])
                 ->all(), 'id', 'name');
    }

    public static function getLastId(){
        return  self::find()->max('id');
    }

}
