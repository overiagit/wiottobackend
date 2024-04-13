<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "accommodation_operator".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $hotel_id
 * @property int|null $supplierOperatorServiceTypeId
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
            [['id', 'hotel_id','supplierOperatorServiceTypeId'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name','supplierOperatorServiceTypeId'], 'safe'],
            [['id'], 'unique'],
            [['hotel_id','supplierOperatorServiceTypeId'], 'exist'
                , 'skipOnError' => true, 'targetClass' => Hotel::className()
                , 'targetAttribute' => ['hotel_id' => 'id']],
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
            'supplierOperatorServiceTypeId'=>Yii::t('app', 'supplierOperatorServiceTypeId'),
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


    public function updateService()
    {
        Yii::$app->db2->createCommand('update services set hotel_id = :hotel_id 
                  , accommodation_operator_id = :accommodation_operator_id
           where supplierOperatorServiceTypeId = :supplierOperatorServiceTypeId', [
            ':hotel_id' => $this->hotel_id, ':accommodation_operator_id' => $this->id,
            ':supplierOperatorServiceTypeId'=>$this->supplierOperatorServiceTypeId,
        ])->execute();

        return true;
    }
}
