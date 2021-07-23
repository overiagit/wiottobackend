<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fe_RoomsImages".
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $room_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $path
 * @property int $isMain
 * @property int|null $orderNr
 */
class RoomImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fe_RoomsImages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_id', 'room_id'], 'required'],
            [['hotel_id', 'room_id', 'isMain', 'orderNr'], 'integer'],
            [['title', 'description', 'path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotel_id' => 'Hotel ID',
            'room_id' => 'Room ID',
            'title' => 'Title',
            'description' => 'Description',
            'path' => 'Path',
            'isMain' => 'Is Main',
            'orderNr' => 'Order Nr',
        ];
    }
}
