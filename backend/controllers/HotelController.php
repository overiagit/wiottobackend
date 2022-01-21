<?php

namespace backend\controllers;

use backend\models\Hotel;
use backend\models\HotelImageSearch;
use backend\models\HotelSearch;
use backend\models\HotelType;
use backend\models\Island;
use backend\models\Town;
use backend\models\TownRegion;
use backend\models\HotelNote;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

/**
 * HotelController implements the CRUD actions for Hotel model.
 */
class HotelController extends Controller
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
     * Lists all Hotel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HotelSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hotel model.
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
     * Creates a new Hotel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hotel();
        $model->id = -1;
        $data['hotel_type'] = HotelType::getList();
        $data['town'] = Town::getList();
        $data['island'] = Island::getList();
        $data['town_region'] = TownRegion::getList();

        $data['note']['en']['note'] = "";
        $data['note']['ru']['note'] = "";
        $data['note']['fr']['note'] = "";

        $data['note']['en']['condition'] = "";
        $data['note']['ru']['condition'] = "";
        $data['note']['fr']['condition'] = "";



        $imageSearchModel = new HotelImageSearch();
        $imageSearchModel->hotel_id = -9999;
        $imageDataProvider = $imageSearchModel->search($this->request->queryParams);
        $imageDataProvider->pagination = ['pageSize' => 1000];


//        if ($this->request->isPost) {
//            if ($model->load($this->request->post()) && $model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
//        } else {
//            $model->loadDefaultValues();
//        }

        if ($this->request->isPost  ) {
            $post = $this->request->post();
            $post['Hotel']['id'] = Hotel::getLastId() + 1;
            if ($model->load($post) ) {
                $model->country_id = 582;
                if ($model->save()) {

//                    $data['note']['ru']['hotel_id'] = $model->id;
//                    $data['note']['fr']['hotel_id'] = $model->id;
//                    $data['note']['ru']['condition'] = $post['condition_ru'];
//                    $data['note']['fr']['condition'] = $post['condition_fr'];
//                    $data['note']['ru']['note'] = $post['note_ru'];
//                    $data['note']['fr']['note'] = $post['note_fr'];


                    $note_en = new HotelNote();
                    $note_en->hotel_id = $model->id;
                    $note_en->lang = 'en';
                    $note_en->note = trim($post['Hotel']['note']);
                    $note_en->condition = trim($post['Hotel']['condition']);
                    $note_en->id = HotelNote::getLastId()+1;

                    $note_ru = new HotelNote();
                    $note_ru->hotel_id = $model->id;
                    $note_ru->lang = 'ru';
                    $note_ru->note = trim($post['note_ru']);
                    $note_ru->condition = trim($post['condition_ru']);
                    $note_ru->id = HotelNote::getLastId()+1;

                    $note_fr = new HotelNote();
                    $note_fr->hotel_id = $model->id;
                    $note_fr->lang = 'fr';
                    $note_fr->note = trim($post['note_fr']);
                    $note_fr->condition = trim($post['condition_fr']);
                    $note_fr->id = HotelNote::getLastId()+2;
                    $res = 0;

                    if (strlen($note_en->note) > 0 || strlen($note_en->condition) > 0)
                        $note_en->save();

                    if (strlen($note_fr->note) > 0 || strlen($note_fr->condition) > 0)
                       $note_fr->save();


                    if (strlen($note_ru->note) > 0 || strlen($note_fr->condition) > 0)
                       $note_ru->save();

                        return $this->redirect(['view', 'id' => $model->id]);

                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'data'=>$data,
            'imageSearchModel' => $imageSearchModel,
            'imageDataProvider' => $imageDataProvider,
        ]);
    }

    /**
     * Updates an existing Hotel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data['hotel_type'] = HotelType::getList();
        $data['town'] = Town::getList();
        $data['island'] = Island::getList();
        $data['town_region'] = TownRegion::getList();

         $data['note']['en'] = HotelNote::find()->where(['hotel_id' => $id,'lang'=>'en'])->one();
         $data['note']['ru'] = HotelNote::find()->where(['hotel_id' => $id,'lang'=>'ru'])->one();
         $data['note']['fr'] = HotelNote::find()->where(['hotel_id' => $id,'lang'=>'fr'])->one();

        if($data['note']['en'] == null){
            $data['note']['en'] =  new HotelNote();
            $data['note']['en']['hotel_id']= $id;
            $data['note']['en']['lang']= 'en';
            $data['note']['en']['note']= null;
            $data['note']['en']['condition']= null;
        }

         if($data['note']['ru'] == null){
             $data['note']['ru'] =  new HotelNote();
             $data['note']['ru']['hotel_id']= $id;
             $data['note']['ru']['lang']= 'ru';
             $data['note']['ru']['note']= null;
             $data['note']['ru']['condition']= null;
         }

        if($data['note']['fr'] == null){
            $data['note']['fr'] =  new HotelNote();
            $data['note']['fr']['hotel_id']= $id;
            $data['note']['fr']['lang']= 'fr';
            $data['note']['fr']['note']= null;
            $data['note']['fr']['condition']= null;

        }


        $imageSearchModel = new HotelImageSearch();
        $imageSearchModel->hotel_id = $id;
        $imageDataProvider = $imageSearchModel->search($this->request->queryParams);
        $imageDataProvider->pagination = ['pageSize' => 1000];


        
//        $data['note']
//        data['note']['ru'] = HotelNote::

        if ($this->request->isPost  ) {
            $post = $this->request->post();
            if ($model->load($post)) {
                $data['note']['ru']['condition'] = $post['condition_ru'];
                $data['note']['fr']['condition'] = $post['condition_fr'];
                $data['note']['en']['condition'] = $post['Hotel']['condition'];
                $data['note']['ru']['note'] = $post['note_ru'];
                $data['note']['fr']['note'] = $post['note_fr'];
                $data['note']['en']['note'] = $post['Hotel']['note'];


                if(!empty($data['note']['en']['note']) || !empty($data['note']['en']['condition']))
                    $data['note']['en']->save();

                if(!empty($data['note']['ru']['note']) || !empty($data['note']['ru']['condition']))
                    $data['note']['ru']->save();

                if(!empty($data['note']['fr']['note']) || !empty($data['note']['fr']['condition']))
                    $data['note']['fr']->save();


                if($model->save())
                    return $this->redirect(['view', 'id' => $model->id]);


            }
        }

        return $this->render('update', [
            'model' => $model,
            'data'=>$data,
            'imageSearchModel' => $imageSearchModel,
            'imageDataProvider' => $imageDataProvider,
        ]);
    }

    /**
     * Deletes an existing Hotel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
//        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hotel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hotel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hotel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
