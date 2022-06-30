<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fe_best_foryou_lang".
 *
 * @property int $id
 * @property string $lang
 * @property string $note
 *
 * @property BestForYou $id0
 */
class BestForyouLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fe_best_foryou_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lang', 'note'], 'required'],
            [['id'], 'integer'],
            [['note'], 'string'],
            [['lang'], 'string', 'max' => 2],
            [['id', 'lang'], 'unique', 'targetAttribute' => ['id', 'lang']],
//            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => BestForYou::className(), 'targetAttribute' => ['id' => 'id']],
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
     * @return \yii\db\ActiveQuery|BestForYouQuery
     */
    public function getId0()
    {
        return $this->hasOne(BestForYou::className(), ['id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BestForyouLangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BestForyouLangQuery(get_called_class());
    }
}
