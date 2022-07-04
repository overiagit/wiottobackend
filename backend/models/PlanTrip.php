<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fe_plan_trip".
 *
 * @property int $id
 * @property string $note
 * @property int $country_id
 * @property string $link
 * @property int|null $col
 * @property int $active
 * @property string $datecreate
 * @property string $datechange
 *
 * @property PlanTripLang[] $PlanTripLangs
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
            [['note', 'link', 'active'], 'required'],
            [['country_id', 'col', 'active'], 'integer'],
            [['datecreate', 'datechange'], 'safe'],
            [['note'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 1024],
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
            'country_id' => Yii::t('app', 'Country ID'),
            'link' => Yii::t('app', 'Link'),
            'col' => Yii::t('app', 'Column'),
            'active' => Yii::t('app', 'Active'),
            'datecreate' => Yii::t('app', 'Datecreate'),
            'datechange' => Yii::t('app', 'Datechange'),
        ];
    }

    /**
     * Gets query for [[FePlanTripLangs]].
     *
     * @return \yii\db\ActiveQuery|PlanTripLangQuery
     */
    public function getPlanTripLangs()
    {
        return $this->hasMany(PlanTripLang::className(), ['id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PlanTripQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanTripQuery(get_called_class());
    }

    public function getNoteRu(){
        return  $this->hasOne(PlanTripLang::className()
            , ['id'=>'id' , ])->andWhere(['lang'=>'ru'])->one();
    }

    public function getNoteFr(){
        return  $this->hasOne(PlanTripLang::className()
            , ['id'=>'id' , ])->andWhere(['lang'=>'fr'])->one();
    }
}
