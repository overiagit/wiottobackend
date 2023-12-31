<?php

namespace backend\controllers;

use backend\models\Hotel;
use backend\models\Room;
use backend\models\RoomImageSearch;
use backend\models\RoomNote;
use backend\models\RoomSearch;
use backend\models\Villa;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoomController implements the CRUD actions for Room model.
 */
class RoomController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Room models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new RoomSearch();
        $searchModel->hotel_id = $id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Room model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (Yii::$app->request->isAjax) {
            $model = new Room();

            if ($this->request->isPost) {
                $post = Yii::$app->request->post();
                $model->name = $post['name'];
                $model->hotel_id = $post['hotel_id'];
                $model->villa = $post['villa'];
                $model->rooms = $post['rooms'];
                $model->exbeds = $post['exb'];
                $model->id = Room::getLastId() + 1;
                if ( $model->save()) {

                    $room['id']= $model->id;
                    $room['name']= $model->name;
                    $room['res']= 'OK';
                }
                else{
                    $room['res']= 'ERROR';
                }
                return json_encode($room);
            }
        ;
        }


        $model = new Room();

        if ($this->request->isPost) {
//            if ($model->load($this->request->post()) && $model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            }

            $post = $this->request->post();
            $model->villa = implode(',',$post['Room']['villa']);

            unset($post['Room']['villa']);


            if($model->load($post)) {



                if ($model->save())
                    return $this->redirect(['view', 'id' => $model->id]);
            }

        }
        else {
            $model->loadDefaultValues();
             $preUrl =  $_SERVER['HTTP_REFERER'];
            $pat = "/id=\d+$/";
             preg_match($pat, $preUrl, $matches );

//             $model->hotel_id  = str_replace("id=","",explode('?',$preUrl)[1]);
            $model->hotel_id =  str_replace("id=","",$matches[0]);

            $model->id = Room::getLastId()+1;

            $country_id = Hotel::getCountry($model->hotel_id);
            $data['villa'] =  Villa::getListByCountry($country_id);

            $data['hotel'] = Hotel::getlist($model->hotel_id);

        }

        return $this->render('create', [
            'model' => $model,
            'data' =>$data,
        ]);
    }

    /**
     * Updates an existing Room model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $country_id = Hotel::getCountry($model->hotel_id);
        $data['villa'] =  Villa::getListByCountry($country_id);
//        $data['villa'] =  Villa::getList();
        $data['hotel'] = Hotel::getlist();

        $data['note']['en'] = RoomNote::find()->where(['room_type_id' => $id,'lang'=>'en'])->one();
        $data['note']['ru'] = RoomNote::find()->where(['room_type_id' => $id,'lang'=>'ru'])->one();
        $data['note']['fr'] = RoomNote::find()->where(['room_type_id' => $id,'lang'=>'fr'])->one();



        if($data['note']['ru'] == null){
            $data['note']['ru'] =  new RoomNote();
            $data['note']['ru']['room_type_id']= $id;
            $data['note']['ru']['lang']= 'ru';
            $data['note']['ru']['note']= null;
        }

        if($data['note']['fr'] == null){
            $data['note']['fr'] =  new RoomNote();
            $data['note']['fr']['room_type_id']= $id;
            $data['note']['fr']['lang']= 'fr';
            $data['note']['fr']['note']= null;

        }

        if($data['note']['en'] == null){
            $data['note']['en'] =  new RoomNote();
            $data['note']['en']['room_type_id']= $id;
            $data['note']['en']['lang']= 'en';
            $data['note']['en']['note']= null;

        }



        $imageSearchModel = new RoomImageSearch();
        $imageSearchModel->room_id = $id;
        $imageDataProvider = $imageSearchModel->search($this->request->queryParams);
        $imageDataProvider->pagination = ['pageSize' => 1000];

        if ($this->request->isPost ){
            $post = $this->request->post();
            $model->villa = implode(',',$post['Room']['villa']);

                unset($post['Room']['villa']);

            $data['note']['ru']['note'] = $post['note_ru'];
            $data['note']['fr']['note'] = $post['note_fr'];
            $data['note']['en']['note'] = $post['note_en'];

            if($model->load($post)){
                if(!empty($data['note']['ru']['note']))
                    $data['note']['ru']->save();

                if(!empty($data['note']['fr']['note']))
                    $data['note']['fr']->save();

                if(!empty($data['note']['en']['note']))
                    $data['note']['en']->save();


                 if($model->save())
                     return $this->redirect(['view', 'id' => $model->id]);

            }


        }

        return $this->render('update', [
            'model' => $model,
            'data' =>$data,
            'imageSearchModel' => $imageSearchModel,
            'imageDataProvider' => $imageDataProvider,
        ]);
    }

    /**
     * Deletes an existing Room model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
//        $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $hotel_id = $model->hotel_id;
        $model->delete();

        return $this->redirect(['index' , 'id'=>$hotel_id]);
    }

    /**
     * Finds the Room model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Room the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Room::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
