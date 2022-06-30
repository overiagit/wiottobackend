<?php

namespace backend\controllers;

use backend\models\BestForYou;
use backend\models\BestForyouLang;
use backend\models\BestForYouQuery;
use backend\models\BestForYouSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BestForYouController implements the CRUD actions for BestForYou model.
 */
class BestForYouController extends Controller
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
     * Lists all BestForYou models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BestForYouSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' =>$searchModel ,
            'dataProvider' => $dataProvider,
        ]);


        /*
              $searchModel = new HotelSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         * */
    }

    /**
     * Displays a single BestForYou model.
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
     * Creates a new BestForYou model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BestForYou();

        $data['en']['note'] = "";
        $data['ru']['note'] = "";
        $data['fr']['note'] = "";

        if ($this->request->isPost) {
            $post = $this->request->post();
            if ($model->load($this->request->post()) && $model->save()) {

                $image = UploadedFile::getInstance($model, 'photo');

                if (!is_null($image)) {
//                    $model->image_src_filename = $image->name;
                    $photo_name = explode(".", $image->name);
                    $ext = end($photo_name);
                    // generate a unique file name to prevent duplicate filenames
                    $model->photo = $model->id.".{$ext}";
                    // the path to save file, you can set an uploadPath
                    // in Yii::$app->params (as used in example below)
                   // Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/status/';
//                    $path1 = "d:/OpenServer/OpenServer/domains/wiotto.com/frontend/webcontent/images/crm-images/best_for_you";


                   // backend/web/upload/best_for_you/2.jpg

//                    $path_tool = Yii::$app->params['best_for_you_photo_tool_path']. $model->photo;
                    $path_tool = Yii::$app->basePath ."/web/upload/best_for_you/". $model->photo;
                    $path_wiotto_com = Yii::$app->params['best_for_you_photo_wiotto_path']. $model->photo;
                    $image->saveAs($path_tool);
                    $image->saveAs($path_wiotto_com);
                    $model->save();
                }

                $note = new BestForyouLang();
                $note->id = $model->id;
                $note->lang = 'ru';
                $note->note = trim($post['note_ru']);
                $note->save();

                $note = new BestForyouLang();
                $note->id = $model->id;
                $note->lang = 'fr';
                $note->note = trim($post['note_fr']);
                $note->save();

                $note = new BestForyouLang();
                $note->id = $model->id;
                $note->lang = 'en';
                $note->note = trim($model->note);
                $note->save();

                return $this->redirect(['index']);


            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'data' =>  $data,
        ]);
    }

    /**
     * Updates an existing BestForYou model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

//        $model->photo =   Yii::$app->params['best_for_you_photo_tool_path']. $model->photo;

        $data['en'] = BestForyouLang::find()->where(['id' => $id,'lang'=>'en'])->one();
        $data['ru'] = BestForyouLang::find()->where(['id' => $id,'lang'=>'ru'])->one();
        $data['fr'] = BestForyouLang::find()->where(['id' => $id,'lang'=>'fr'])->one();

        if($data['en'] == null){
            $data['en'] =  new BestForyouLang();
            $data['en']['id']= $id;
            $data['en']['lang']= 'en';
            $data['en']['note']= null;
        }

        if($data['ru'] == null){
            $data['ru'] =  new BestForyouLang();
            $data['ru']['id']= $id;
            $data['ru']['lang']= 'ru';
            $data['ru']['note']= null;
        }

        if($data['fr'] == null){
            $data['fr'] =  new BestForyouLang();
            $data['fr']['id']= $id;
            $data['fr']['lang']= 'fr';
            $data['fr']['note']= null;
        }

        if($this->request->isGet)
            $model->photo = "/upload/best_for_you/". $model->photo;

        if ($this->request->isPost) {
                $post = $this->request->post();
                $photo = $model->photo;
                $model->photo =   $photo;
            if ($model->load($this->request->post()))
            {
                $model->photo =   $photo;
                if ($model->save()) {
                    $image = UploadedFile::getInstance($model, 'photo');
                    if (!is_null($image)) {
                        $photo_name = explode(".", $image->name);
                        $ext = end($photo_name);
                        $model->photo = $model->id . ".{$ext}";

                        $path_tool = Yii::$app->basePath . "/web/upload/best_for_you/" . $model->photo;
                        $path_wiotto_com = Yii::$app->params['best_for_you_photo_wiotto_path'] . $model->photo;
                        $image->saveAs($path_tool);
                        $image->saveAs($path_wiotto_com);
                        $model->save();
                    }
                    $data['ru']['note'] = trim($post['note_ru']);
                    $data['fr']['note'] = trim($post['note_fr']);
                    $data['en']['note'] = trim($model->note);

                    if(!empty($data['ru']['note']))
                        $data['ru']->save();
                    if(!empty($data['fr']['note']))
                        $data['fr']->save();
                    if(!empty($data['en']['note']))
                        $data['en']->save();

                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    /**
     * Deletes an existing BestForYou model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the BestForYou model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BestForYou the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BestForYou::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
