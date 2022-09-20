<?php

namespace backend\controllers;

use backend\models\Coupon;
use backend\models\CouponLang;
use backend\models\CouponSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CouponController implements the CRUD actions for Coupon model.
 */
class CouponController extends Controller
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
     * Lists all Coupon models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CouponSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Coupon model.
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
     * Creates a new Coupon model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Coupon();

        $data['descrition']['en']['descrition'] = "";
        $data['descrition']['ru']['descrition'] = "";
        $data['descrition']['fr']['descrition'] = "";


        if ($this->request->isPost) {
            $post = $this->request->post();
            if ($model->load($post) && $model->save()) {

                $cLang = new CouponLang();
                $cLang->id = $model->id;

                if($model->description) {
                    $cLang->lang = 'en';
                    $cLang->description = $model->description;
                    $cLang->save();
                }
                if($post["description_ru"]) {
                    $cLang = new CouponLang();
                    $cLang->id = $model->id;
                    $cLang->lang = 'ru';
                    $cLang->description = $post["description_ru"];
                    $cLang->save();
                }
                if($post["description_fr"]) {
                    $cLang = new CouponLang();
                    $cLang->id = $model->id;
                    $cLang->lang = 'fr';
                    $cLang->description = $post["description_fr"];
                    $cLang->save();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
            $model->date_from =  date('Y-m-d');
        }

        return $this->render('create', [
            'model' => $model,"data"=>$data
        ]);
    }

    /**
     * Updates an existing Coupon model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

//        $descEn =  CouponLang::findOne(["id"=>$id,'lang'=>'en']);
//        $descFr =   CouponLang::findOne(["id"=>$id,'lang'=>'fr']);
//        $descRu =  CouponLang::findOne(["id"=>$id,'lang'=>'ru']);
//
//        if(!$descEn){
//            $descEn = new CouponLang();
//            $descEn->lang = 'en';
//            $descEn->description = 'en';
//        }
//        if(!$descRu){
//            $descRu = new CouponLang();
//            $descRu->lang = 'ru';
//            $descRu->description = 'ru';
//        }
//        if(!$descFr){
//            $descFr = new CouponLang();
//            $descFr->lang = 'fr';
//            $descFr->description = 'fr';
//        }


        $data['description']['en'] = CouponLang::findOne(["id"=>$id,'lang'=>'en']);
        $data['description']['ru'] = CouponLang::findOne(["id"=>$id,'lang'=>'ru']);
        $data['description']['fr'] = CouponLang::findOne(["id"=>$id,'lang'=>'fr']);

        if($data['description']['en'] == null){
            $data['description']['en'] =  new CouponLang();
            $data['description']['en']['id']= $id;
            $data['description']['en']['lang']= 'en';
            $data['description']['en']['description']= null;
        }

        if($data['description']['ru'] == null){
            $data['description']['ru'] =  new CouponLang();
            $data['description']['ru']['id']= $id;
            $data['description']['ru']['lang']= 'ru';
            $data['description']['ru']['description']= null;
        }
        if($data['description']['fr'] == null){
            $data['description']['fr'] =  new CouponLang();
            $data['description']['fr']['id']= $id;
            $data['description']['fr']['lang']= 'fr';
            $data['description']['fr']['description']= null;
        }


        if ($this->request->isPost) {
            $post = $this->request->post();
            if ($model->load($post) && $model->save()) {
                $data['description']['ru']['description'] = $post['description_ru'];
                $data['description']['fr']['description'] = $post['description_fr'];
                $data['description']['en']['description'] = $post['Coupon']['description'];

                if(!empty($data['description']['en']['description']))
                    $data['description']['en']->save();

                if(!empty($data['description']['ru']['description']))
                    $data['description']['ru']->save();

                if(!empty($data['description']['fr']['description']))
                    $data['description']['fr']->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,"data"=>$data
        ]);
    }

    /**
     * Deletes an existing Coupon model.
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
     * Finds the Coupon model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Coupon the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Coupon::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
