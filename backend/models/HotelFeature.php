<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_hotel_feature".
 *
 * @property int $id
 * @property int $hotel_id
 * @property string|null $name
 */
class HotelFeature extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_hotel_feature';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hotel_id'], 'required'],
            [['id', 'hotel_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hotel_id' => Yii::t('app', 'Hotel ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    public static function getByHotel($hotel_id)
    {
//        return ArrayHelper::getValue( self::find()->where(['hotel_id'=>$hotel_id])->select('id')->asArray()->all() , 'id' );

     //   return  self::find()->where(['hotel_id'=>$hotel_id])->select('id')->all() ;
        return  ArrayHelper::getColumn(self::find()->where(['hotel_id'=>$hotel_id])->select('id')->all(), 'id') ;
       // return  self::find()->where(['hotel_id'=>$hotel_id]) ;


    }

//    public static function getList()
//    {
//        return ArrayHelper::map(self::find()
//            ->innerJoin('t_town', 't_town_region.town_id = t_town.id' )
//            ->where(['t_town.country_id'=>582])->select('t_town_region.id as id, t_town_region.name as name')->all(), 'id', 'name');
//    }




}
