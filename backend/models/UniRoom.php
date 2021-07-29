<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_uni_room_type".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $room_type_id
 * @property int|null $hotel_uni_id
 * @property int|null $hotel_id
 * @property string|null $description
 * @property string|null $date_add
 */
class UniRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_uni_room_type';
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
            [['id', 'room_type_id', 'hotel_uni_id', 'hotel_id'], 'integer'],
            [['date_add'], 'safe'],
            [['title', 'description'], 'string', 'max' => 255],
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
            'room_type_id' => 'Room Type ID',
            'hotel_uni_id' => 'Hotel Uni ID',
            'hotel_id' => 'Hotel ID',
            'description' => 'Description',
            'date_add' => 'Date Add',
        ];
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
         return $this->hasOne(Room::className(), ['id' => 'room_type_id']);
    }



    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUniHotel()
    {
        $uh = $this->hasOne(UniHotel::className(), ['id' => 'hotel_uni_id'])->one();
        return $uh;
    }

    public function getRoomName()
    {
        $item = $this->getRoom()->one();
        if($item) {
            return $item->getAttribute('name');
        }
    }
}
