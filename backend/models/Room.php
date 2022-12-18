<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_room_type".
 *
 * @property int $id
 * @property string $name
 * @property string $villa
 * @property int $rooms
 * @property int $exbeds
 * @property string|null $note
 * @property int|null $hotel_id
 * @property int|null $active
 * @property int|null $uni_room_type_id


 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_room_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db1');
    }


    public function getVilla()
    {
        return explode(',',$this->villa);
    }

    public function setVilla($value)
    {

        $this->villa = !is_array($value) ?: implode(',',$value);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id', 'rooms', 'exbeds', 'hotel_id', 'active', 'uni_room_type_id'], 'integer'],
            [['note'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['villa'], 'string', 'max' => 25],
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
            'name' => 'Name',
            'villa' => 'Villa',
            'rooms' => 'Rooms',
            'exbeds' => 'Exbeds',
            'note' => 'Note',
            'hotel_id' => 'Hotel ID',
            'active' => 'Active',
            'uni_room_type_id' => 'Uni Room Type ID',
        ];
    }

    public static function getList($hotel_id)
    {
        return ArrayHelper::map(self::find()->where(['hotel_id'=>$hotel_id])->select('id, name')->all(), 'id', 'name');
    }

    public static function getDataList($hotel_id)
    {
        return ArrayHelper::map(self::find()->where(['hotel_id'=>($hotel_id ?? -888)])
            ->select(['id', "concat(name , ' ', id , ' hоtel_id=', hotel_id) as name"])->all(), 'id', 'name');
    }

    public static function getLastId(){
      return  self::find()->max('id');
    }

//    /**
//     * Gets query for [[THotelStops]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getTHotelStops()
//    {
//        return $this->hasMany(THotelStops::className(), ['room_type_id' => 'id']);
//    }
//
    /**
     * Gets query for [[TUniRoomType1s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUniRooms()
    {
        return $this->hasMany(UniRoom::className(), ['room_type_id' => 'id']);
    }


    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'hotel_id'])->one();

    }


    /**
     * Gets ids .
     *
     * @return string
     */
    public function getUniRoomIds()
    {
        $ids = $this->getUniRooms()->select(["ifnull(group_concat(id),'no') as ids"])->scalar();

        return substr($ids,0,10).' ...';
    }

    /**
     * Gets ids .
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(RoomImage::className(), ['room_id' => 'id']);
    }

    /**
     * Gets ids .
     *
     * @return string
     */
    public function getImageIds()
    {
        return $this->getImages()->select(["group_concat(id) as ids"])->scalar()??'no';
    }

    /**
     * Gets img count .
     *
     * @return int
     */
    public function getImageCount()
    {
        return $this->getImages()->count();
    }

    /**
     * Gets ids .
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoteLang()
    {
        return $this->hasMany(RoomNote::className(), ['room_type_id' => 'id']);
    }

    /**
     * Gets ids .
     *
     * @return array
     */
    public function getNoteLangRu()
    {
        return $this->getNoteLang()->where(['lang'=>'ru'])->one();
    }

    /**
     * Gets ids .
     *
     * @return array
     */
    public function getNoteLangFr()
    {
        return $this->getNoteLang()->where(['lang'=>'fr'])->one();
    }


}
