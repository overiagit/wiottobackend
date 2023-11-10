<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_option".
 *
 * @property int $id
 * @property int $type 0-hotel,1-room type
 * @property string $name
 * @property int $show
 * @property int $show_list
 * @property int|null $uni_id id from uni
 * @property string|null $tourplan_code
 * @property int|null $country_id
 * @property int|null $group_id
 *
 * @property OptionGroup $group
 * @property Hotel[] $hotels
 * @property Hotel[] $hotels0
 * @property HotelOption230809[] $tHotelOption230809s
 * @property HotelOption[] $tHotelOptions
 */
class Option extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_option';
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
            [['id', 'type', 'name'], 'required'],
            [['id', 'type', 'show', 'show_list','uni_id', 'country_id', 'group_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['tourplan_code'], 'string', 'max' => 20],
            [['id', 'type'], 'unique', 'targetAttribute' => ['id', 'type']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => OptionGroup::class, 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', '0-hotel,1-room type'),
            'name' => Yii::t('app', 'Name'),
            'show' => Yii::t('app', 'Show (NOT best for you) '),
            'show_list' => Yii::t('app', 'Show in hotel item 2page '),
            'uni_id' => Yii::t('app', 'id from uni'),
            'tourplan_code' => Yii::t('app', 'Tourplan Code'),
            'country_id' => Yii::t('app', 'Country ID'),
            'group_id' => Yii::t('app', 'Group ID'),
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery|OptionGroupQuery
     */
    public function getGroup()
    {
       return $this->hasOne(OptionGroup::class, ['id' => 'group_id'])->one();

    }

    /**
     * Gets query for [[Hotels]].
     *
     * @return \yii\db\ActiveQuery|HotelQuery
     */
    public function getHotels()
    {
        return $this->hasMany(Hotel::class, ['id' => 'hotel_id'])->viaTable('t_hotel_option', ['option_id' => 'id']);
    }

    /**
     * Gets query for [[Hotels0]].
     *
     * @return \yii\db\ActiveQuery|HotelQuery
     */
    public function getHotels0()
    {
        return $this->hasMany(Hotel::class, ['id' => 'hotel_id'])->viaTable('t_hotel_option_230809', ['option_id' => 'id']);
    }

    /**
     * Gets query for [[THotelOption230809s]].
     *
     * @return \yii\db\ActiveQuery|HotelOption230809Query
     */
    public function getTHotelOption230809s()
    {
        return $this->hasMany(HotelOption230809::class, ['option_id' => 'id']);
    }

    /**
     * Gets query for [[THotelOptions]].
     *
     * @return \yii\db\ActiveQuery|HotelOptionQuery
     */
    public function getHotelOptions()
    {
        return $this->hasMany(HotelOption::class, ['option_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return OptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OptionQuery(get_called_class());
    }
}
