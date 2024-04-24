<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property int|null $supplierOperatorServiceTypeId
 * @property string|null $name
 * @property int|null $minimumPax
 * @property int|null $maximumPax
 * @property int $isInactive
 * @property int|null $room_type_id
 * @property int|null $hotel_id
 * @property int|null $accommodation_operator_id
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    public static function getCountNotLinkedRooms()
    {
        return  self::find()->select(['distinct services.id'])
            ->innerJoin('supplieroperatorservicetype', 'supplieroperatorservicetype.id = services.supplierOperatorServiceTypeId')
            ->innerJoin('accommodation_operator', 'accommodation_operator.id = supplieroperatorservicetype.supplierServiceOperatorId')
            ->where(['is', 'services.room_type_id'
                , new \yii\db\Expression('null')])
            ->andWhere('supplieroperatorservicetype.serviceType=7')

            ->count();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'isInactive'], 'required'],
            [['id', 'supplierOperatorServiceTypeId', 'minimumPax', 'maximumPax', 'isInactive', 'room_type_id', 'hotel_id'
              ,'accommodation_operator_id' ], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'supplierOperatorServiceTypeId' => Yii::t('app', 'Supplier Operator Service Type ID'),
            'name' => Yii::t('app', 'Name'),
            'minimumPax' => Yii::t('app', 'Minimum Pax'),
            'maximumPax' => Yii::t('app', 'Maximum Pax'),
            'isInactive' => Yii::t('app', 'Is Inactive'),
            'room_type_id' => Yii::t('app', 'Wiotto Room Type ID'),
            'hotel_id' => Yii::t('app', 'Wiotto Hotel ID'),
            'accommodation_operator_id'=>Yii::t('app', 'Astro Hotel ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ServicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServicesQuery(get_called_class());
    }

    public function getAccommodationOperatorName($accommodation_operator_id)
    {

        return Yii::$app->db2->createCommand('select name from accommodation_operator
           where id = :accommodation_operator_id', [
            ':accommodation_operator_id' => $this->accommodation_operator_id,
        ])->queryScalar();


    }
}
