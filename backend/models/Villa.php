<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_villa".
 *
 * @property int $id
 * @property string $name
 * @property string|null $note
 */
class Villa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_villa';
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
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['note'], 'string'],
            [['name'], 'string', 'max' => 128],
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
            'note' => 'Note',
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->select('id, name')->all(), 'id', 'name');
    }

    public static function getListByCountry($country_id)
    {
        return ArrayHelper::map(self::find()->where(['country_id'=>[null, $country_id]])->select('id, name')->all(), 'id', 'name');
    }
}
