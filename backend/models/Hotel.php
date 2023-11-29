<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_hotel".
 *
 * @property int $id
 * @property int $type_id
 * @property int $town_id
 * @property string $name
 * @property float|null $latitude
 * @property float|null $longitude
 * @property int|null $town_region_id
 * @property string|null $comment
 * @property string|null $note
 * @property int|null $location_id
 * @property int $country_id
 * @property int|null $island_id
 * @property string|null $condition
 * @property int $on_request
 * @property UniHotel[] $UniHotels
 * @property array $features
 */




class Hotel extends \yii\db\ActiveRecord
{

    public $features;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_hotel';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db1');
    }

    public static function getCountry( $hotel_id)
    {
         return  self::find()->where(['id'=>$hotel_id])->select('country_id')->one()["country_id"];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'town_id', 'name', 'country_id'], 'required', 'message' => 'Requered filds'],
            [['id', 'type_id', 'town_id', 'town_region_id', 'location_id', 'country_id', 'island_id', ], 'integer', 'message' => 'Requered int'],
            [['latitude', 'longitude'], 'number', 'message' => 'Requered number'],
            [['comment', 'note', 'condition'], 'string'],
            [['name'], 'string', 'max' => 128],
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
            'type_id' => 'Type ID',
            'town_id' => 'Town ID',
            'name' => 'Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'town_region_id' => 'Town Region ID',
            'comment' => 'Comment',
            'note' => 'Note',
            'location_id' => 'Location ID',
            'country_id' => 'Country ID',
            'island_id' => 'Island ID',
            'condition' => 'Condition',
//            'images' => 'Images'
        ];
    }


    /**
     * Gets query for [[TUniHotels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUniHotels()
    {
        return $this->hasMany(UniHotel::className(), ['hotel_id' => 'id']);
    }

    /**
     * Gets query for [[TUniRoomType1s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUniRoomType()
    {
        return null;
//        return $this->hasMany(UniRoomType::className(), ['hotel_id' => 'id']);
    }

    public function getHotelName()
    {
        return $this->name;
//        return $this->hasMany(UniRoomType::className(), ['hotel_id' => 'id']);
    }

    public function getFeatures(){
      //  return HotelFeature::getByHotel($this->id);
        return $this->hasMany(Feature::className(), ['id' => 'id'])->viaTable('t_hotel_option', ['hotel_id' => 'id']);
    }

//    public function getImages(){
//        return $this->hasMany(HotelImage::className(), ['id' => 'id'])->viaTable('wiotto_uni_db.fe_HotelsImages', ['hotel_id' => 'id']);
////     return "eeeemy_images";
//
//    }

    public function getImagesIds(){
        $ids = $this->hasMany(HotelImage::className()
            , ['hotel_id' => 'id'])
            ->select("GROUP_CONCAT(id)")->scalar()??'no';

        return substr($ids,0,10).' ...';
    }

    public static function getList($id = null)
    {
        if(is_null($id))
           return ArrayHelper::map(self::find()->select('id, name')->all(), 'id', 'name');
        else
            return ArrayHelper::map(self::find()->where(['id'=>$id])->select('id, name')->all(), 'id', 'name');
    }

    public static function getHotelDataList()
    {
        return ArrayHelper::map(self::find()
            ->leftJoin('t_hotel_type', 't_hotel.type_id = t_hotel_type.id')
            ->leftJoin('t_town_region', 't_hotel.town_region_id = t_town_region.id')
            ->leftJoin('t_island', 't_hotel.island_id = t_island.id')
//            ->leftJoin('fe_HotelsImages', 't_hotel.id = t_island.id')
            ->select(["`t_hotel`.`id` as `id`"
                , "concat(`t_hotel`.`name`,' ', ifnull(`t_hotel_type`.`name`,'') 
                 , ifnull( concat(' region:' ,`t_town_region`.`name` ),'') 
                 , ifnull(concat(' island:',`t_island`.`name` ),'')) as `name`"])
            ->orderBy(['`t_hotel`.`name`'=>SORT_ASC])
                 ->all(), 'id', 'name');
    }

    public  static function getHotelsTourplan(){
        $sql =  "select  h.id , concat(h.id , ' ', th.SupplierName, ' ' , ifnull(th.ClassDescription,'') 
        , ' ', ifnull(th.LocalityDescription,'') , ' ' , c.`name`)  as hotel 
        from t_hotel h 
        inner join t_tourplan_hotel th on th.SupplierId = h.tourplan_id
        left join wiotto_db.t_country c on c.id = h.country_id 
        where h.tourplan_code is not  null 
        order by th.SupplierName;";
        $cmd = self::getDb()->createCommand($sql);
         $hotels =  $cmd->queryAll();
         return $hotels;
    }

    public  static  function getHotelsOnRequest(){
        $hotels = self::find()->where(['on_request' => 1])
            ->select(["id"])
            ->asArray() // Добавимо цей метод, щоб отримати результат як масив
            ->all();

        $hotelIds = array_column($hotels, 'id'); // Витягаємо тільки значення 'id' з масиву об'єктів

        return $hotelIds; // Повертаємо масив зі значеннями 'id'
    }

    public static function getLastId(){
        return  self::find()->max('id');
    }

    public function saveFeatures(array $features){

        $sql = sprintf("delete from wiotto_db.t_hotel_option where hotel_id = %d",$this->id);
        $cmd = self::getDb()->createCommand($sql);
        $cmd->execute();

        foreach($features as $key=>$val){
            $sql = sprintf("insert into wiotto_db.t_hotel_option(hotel_id, option_id) values(%d, %d)",$this->id , $val );
            $cmd = self::getDb()->createCommand($sql);
            $cmd->execute();
        }
    }

    public static function saveOnRequest(array $onreq){
        $onreq = implode(',',$onreq);

        $sql = sprintf("update  wiotto_db.t_hotel set on_request=0 where id not in (%s);
                               update  wiotto_db.t_hotel set on_request=1 where id  in (%s);",$onreq, $onreq);
        $cmd = self::getDb()->createCommand($sql);
        $cmd->execute();


    }

    /**
     * Gets ids .
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(HotelImage::className(), ['hotel_id' => 'id']);
    }
}
