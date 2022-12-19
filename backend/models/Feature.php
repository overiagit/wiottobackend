<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_feature".
 *
 * @property int $id
 * @property int $type 0-hotel,1-room type
 * @property string $name
 */
class Feature extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_feature';
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id', 'type'], 'integer'],
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
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return FeatureQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeatureQuery(get_called_class());
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->select('`id`, `num_name` as name')->all(), 'id', 'name');

    }


}
