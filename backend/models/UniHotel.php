<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_uni_hotel".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $starId
 * @property int|null $ResortId
 * @property int|null $CountryId
 * @property int|null $hotel_id
 * @property number|null $Longitude
 * @property number|null $Latitude
 * @property string|null $date_add
 * @property string|null $wiotto_hotel_name
 * @property  number|null $location_id

 *
 * @property Hotel $hotel
 */
class UniHotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

//    public $wiotto_hotel_name;


    public static function tableName()
    {
        return 't_uni_hotel';
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
            [['id', 'starId', 'ResortId', 'CountryId', 'hotel_id', 'location_id'], 'integer'],
            [['location_id','Longitude', 'Latitude'], 'number'],
            [['date_add'], 'safe'],
            [['title'], 'string', 'max' => 255],
//            [['Longitude', 'Latitude'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::className(), 'targetAttribute' => ['hotel_id' => 'id']],
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
            'starId' => 'Star ID',
            'ResortId' => 'Resort ID',
            'CountryId' => 'Country ID',
            'hotel_id' => 'Hotel ID',
            'Longitude' => 'Longitude',
            'Latitude' => 'Latitude',
            'date_add' => 'Date Add',
            'wiotto_hotel_name' => 'wiotto_hotel_name',
            'location_id' => 'location_id',
        ];
    }

    /**
     * Gets query for [[Hotel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'hotel_id']);
    }



    public function getHotelName()
    {
        $hotel = $this->getHotel()->one();
        if($hotel) {
            return $hotel->getAttribute('name');
        }
    }

    public function getStarName()
    {
        $star = $this->getStar()->one();
        if($star)
            return $star->getAttribute('title');
    }

    public function getStar()
    {
        return $this->hasOne(UniHotelStar::className(), ['id' => 'starId']);
    }


    public function getResortName()
    {
        $item = $this->getResort()->one();
        if($item)
            return $item->getAttribute('TitleEn');
    }


    public function updateRooms()
    {
        Yii::$app->db1->createCommand('update t_uni_room_type set hotel_id = :hotel_id
           where hotel_uni_id = :hotel_uni_id', [
            ':hotel_id' => $this->hotel_id, ':hotel_uni_id' => $this->id,
        ])->execute();

         return true;
    }

    public function updateLocation()
    {
        Yii::$app->db1->createCommand('update t_uni_hotel set location_id = :location_id
           where hotel_uni_id = :hotel_uni_id', [
            ':location_id' => $this->location_id, ':hotel_uni_id' => $this->id,
        ])->execute();

        return true;
    }

    public function getResort()
    {
        $uh = $this->hasOne(UniResort::className(), ['id' => 'ResortId']);
        return $uh;
    }

    public function getCountryName()
    {
        $item = $this->getCountry()->one();
        if($item)
            return $item->getAttribute('titleEn');
    }

    public function getCountry()
    {
        return $this->hasOne(UniCountry::className(), ['id' => 'CountryId']);
    }
}
