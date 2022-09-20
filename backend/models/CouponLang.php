<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_coupon_lang".
 *
 * @property int $id
 * @property string $lang
 * @property string $description
 *
 * @property Coupon $id0
 */
class CouponLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_coupon_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lang', 'description'], 'required'],
            [['id'], 'integer'],
            [['lang'], 'string', 'max' => 2],
            [['description'], 'string', 'max' => 255],
            [['id', 'lang'], 'unique', 'targetAttribute' => ['id', 'lang']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Coupon::class, 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lang' => Yii::t('app', 'Lang'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery|CouponQuery
     */
    public function getId0()
    {
        return $this->hasOne(Coupon::class, ['id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CouponLangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CouponLangQuery(get_called_class());
    }
}
