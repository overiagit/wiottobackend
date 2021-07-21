<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_uni_country".
 *
 * @property int $id
 * @property string|null $titleEn
 * @property string|null $titleRu
 * @property int|null $country_id
 */
class UniCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_uni_country';
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
            [['id'], 'required'],
            [['id', 'country_id'], 'integer'],
            [['titleEn', 'titleRu'], 'string', 'max' => 45],
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
            'titleEn' => 'Title En',
            'titleRu' => 'Title Ru',
            'country_id' => 'Country ID',
        ];
    }
}
