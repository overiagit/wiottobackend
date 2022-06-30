<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fe_plan_trip".
 *
 * @property int $id
 * @property string|null $note
 * @property string|null $link
 *
 * @property FePlanTripLang[] $fePlanTripLangs
 */
class PlanTrip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fe_plan_trip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['note'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 1024],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'note' => Yii::t('app', 'Note'),
            'link' => Yii::t('app', 'Link'),
        ];
    }

    /**
     * Gets query for [[FePlanTripLangs]].
     *
     * @return \yii\db\ActiveQuery|FePlanTripLangQuery
     */
    public function getFePlanTripLangs()
    {
        return $this->hasMany(FePlanTripLang::className(), ['id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PlanTripQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanTripQuery(get_called_class());
    }
}
