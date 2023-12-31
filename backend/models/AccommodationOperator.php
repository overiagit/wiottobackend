<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "accommodation_operator".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $hotel_id
 */
class AccommodationOperator extends \yii\db\ActiveRecord
{
//     private $wiotto_hotel_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accommodation_operator';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'hotel_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'hotel_id' => Yii::t('app', 'Hotel ID'),
//            'wiotto_hotel_name' => 'wiotto_hotel_name',
        ];
    }

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


    /**
     * {@inheritdoc}
     * @return AccommodationOperatorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccommodationOperatorQuery(get_called_class());
    }
}
