<?php

namespace backend\controllers;

use backend\models\Hotel;
use backend\models\HotelSearch;
use backend\models\HotelType;
use backend\models\Island;
use backend\models\Town;
use backend\models\TownRegion;
use backend\models\HotelNote;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
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
        
      
         $data['note']['ru'] = HotelNote::find()->where(['hotel_id' => $id,'lang'=>'ru'])->one();
         $data['note']['fr'] = HotelNote::find()->where(['hotel_id' => $id,'lang'=>'fr'])->one();
        
//        $data['note']
//        data['note']['ru'] = HotelNote::

        if ($this->request->isPost  ) {
            $post = $this->request->post();
            if ($model->load($post)) {
                $data['note']['ru']['condition'] = $post['condition_ru'];
                $data['note']['fr']['condition'] = $post['condition_fr'];
                $data['note']['ru']['note'] = $post['note_ru'];
                $data['note']['fr']['note'] = $post['note_fr'];
                if ($data['note']['fr']->save()
                    && $data['note']['ru']->save()
                    && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'data'=>$data,
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
