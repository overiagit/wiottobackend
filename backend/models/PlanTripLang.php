<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fe_plan_trip_lang".
 *
 * @property int $id
 * @property string $lang
 * @property string $note
 *
 * @property FePlanTrip $id0
 */
class PlanTripLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fe_plan_trip_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lang', 'note'], 'required'],
            [['id'], 'integer'],
            [['lang'], 'string', 'max' => 2],
            [['note'], 'string', 'max' => 1024],
            [['id', 'lang'], 'unique', 'targetAttribute' => ['id', 'lang']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => FePlanTrip::className(), 'targetAttribute' => ['id' => 'id']],
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
            'note' => Yii::t('app', 'Note'),
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery|FePlanTripQuery
     */
    public function getId0()
    {
        return $this->hasOne(FePlanTrip::className(), ['id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PlanTripLangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanTripLangQuery(get_called_class());
    }
}
