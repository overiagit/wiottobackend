<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_hotel_note".
 *
 * @property int $id
 * @property int $hotel_id
 * @property string $lang
 * @property string|null $note
 * @property string|null $condition
 * @property string|null $name
 */
class HotelNote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_hotel_note';
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
            [['hotel_id', 'lang'], 'required'],
            [['hotel_id'], 'integer'],
            [['note', 'condition'], 'string'],
            [['lang'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 128],
            [['hotel_id', 'lang'], 'unique', 'targetAttribute' => ['hotel_id', 'lang']],
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
            'lang' => 'Lang',
            'note' => 'Note',
            'condition' => 'Condition',
            'name' => 'Name',
        ];
    }
}
