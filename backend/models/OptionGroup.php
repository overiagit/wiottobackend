<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_option_group".
 *
 * @property int $id
 * @property string $name
 * @property mixed|null $country_id
 * @property mixed|null $country_ids
 * @property OptionGroupLocalization[] $OptionGroupLocalizations
 * @property Option[] $Options
 */
class OptionGroup extends \yii\db\ActiveRecord
{
    public $country_ids ;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_option_group';
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
            [['name'], 'required'],
//            [['country_id'], 'integer'],
            [['name','country_id'], 'string', 'max' => 255],
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
            'country_id' => Yii::t('app', 'Country ID'),
        ];
    }

    /**
     * Gets query for [[OptionGroupLocalizations]].
     *
     * @return \yii\db\ActiveQuery|OptionGroupLocalizationQuery
     */
    public function getOptionGroupLocalizations()
    {
        return $this->hasMany(OptionGroupLocalization::class, ['id' => 'id']);
    }

    /**
     * Gets query for [[TOptions]].
     *
     * @return \yii\db\ActiveQuery|OptionQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Option::class, ['group_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return OptionGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OptionGroupQuery(get_called_class());
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->select('id, name')->all(), 'id', 'name');
    }
}
