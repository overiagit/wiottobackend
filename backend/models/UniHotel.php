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
 * @property string|null $Longitude
 * @property string|null $Latitude
 * @property string|null $date_add
 *  @property string|null $wiotto_hotel_name
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
            [['id', 'starId', 'ResortId', 'CountryId', 'hotel_id'], 'integer'],
            [['date_add'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['Longitude', 'Latitude'], 'string', 'max' => 45],
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

    public function getResort()
    {
        return $this->hasOne(UniResort::className(), ['id' => 'ResortId']);
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
