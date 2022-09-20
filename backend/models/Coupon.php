<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_coupon".
 *
 * @property int $id
 * @property string $name
 * @property string|null $note
 * @property string|null $description
 * @property int $percent
 * @property string $date_from
 * @property string|null $date_to
 * @property int $active
 */
class Coupon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_coupon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'percent'], 'required'],
            [['percent', 'active'], 'integer'],
            [['date_from', 'date_to'], 'safe'],
            [['name', 'note','description'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'note' => Yii::t('app', 'Note'),
            'description' => Yii::t('app', 'Description'),
            'percent' => Yii::t('app', 'Percent'),
            'date_from' => Yii::t('app', 'Date From'),
            'date_to' => Yii::t('app', 'Date To'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CouponQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CouponQuery(get_called_class());
    }
}
