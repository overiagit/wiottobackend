<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_room_type_note".
 *
 * @property int $id
 * @property int $room_type_id
 * @property string $lang
 * @property string $note
 * @property string|null $name
 */
class RoomNote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_room_type_note';
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
            [['room_type_id', 'lang', 'note'], 'required'],
            [['room_type_id'], 'integer'],
            [['note'], 'string'],
            [['lang'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 128],
            [['room_type_id', 'lang'], 'unique', 'targetAttribute' => ['room_type_id', 'lang']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_type_id' => 'Room Type ID',
            'lang' => 'Lang',
            'note' => 'Note',
            'name' => 'Name',
        ];
    }
}
