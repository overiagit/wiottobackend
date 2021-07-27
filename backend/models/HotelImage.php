<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fe_HotelsImages".
 *
 * @property int $id
 * @property int $hotel_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $path
 * @property int $isMain
 * @property int|null $orderNr
 */
class HotelImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fe_HotelsImages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_id'], 'required'],
            [['hotel_id', 'isMain', 'orderNr'], 'integer'],
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
            'title' => 'Title',
            'description' => 'Description',
            'path' => 'Path',
            'isMain' => 'Is Main',
            'orderNr' => 'Order Nr',
        ];
    }

    public static function getLastId(){
        return  self::find()->max('id');
    }
}
