<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fe_best_for_you".
 *
 * @property int $id
 * @property string $note
 * @property string $photo
 * @property string $link
 * @property int $country_id
 * @property int $active
 * @property int $row
 * @property string $dateadd
 * @property string $datechange
 */
class BestForYou extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fe_best_for_you';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note',  'link'], 'required'],
            [['note', 'link'], 'string'],
            [['country_id', 'active', 'row'], 'integer'],
            [['dateadd', 'datechange'], 'safe'],
            [[ 'photo'], 'string', 'max' => 255],
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
            'photo' => Yii::t('app', 'Photo'),
            'link' => Yii::t('app', 'Link'),
            'country_id' => Yii::t('app', 'Country ID'),
            'active' => Yii::t('app', 'Active'),
            'row' => Yii::t('app', 'Row'),
            'dateadd' => Yii::t('app', 'Dateadd'),
            'datechange' => Yii::t('app', 'Datechange'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return BestForYouQuery the active query used by this AR class.
     */
//    public static function find()
//    {
//        return new BestForYouQuery(get_called_class());
//    }

      public function getNoteRu(){
        return  $this->hasOne(BestForyouLang::className()
            , ['id'=>'id' , ])->andWhere(['lang'=>'ru'])->one();
      }

    public function getNoteFr(){
        return  $this->hasOne(BestForyouLang::className()
            , ['id'=>'id' , ])->andWhere(['lang'=>'fr'])->one();
    }
}
