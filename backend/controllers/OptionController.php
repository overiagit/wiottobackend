<?php

namespace backend\controllers;

use backend\models\Option;
use backend\models\OptionGroup;
use backend\models\OptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OptionController implements the CRUD actions for Option model.
 */
class OptionController extends Controller
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
     * Lists all Option models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OptionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Option model.
     * @param int $id ID
     * @param int $type 0-hotel,1-room type
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $type)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $type),
        ]);
    }

    /**
     * Creates a new Option model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Option();
        $data['option_group'] = OptionGroup::getList();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'type' => $model->type]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'data'=>$data,
        ]);
    }

    /**
     * Updates an existing Option model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $type 0-hotel,1-room type
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $type)
    {
        $model = $this->findModel($id, $type);
        $data['option_group'] = OptionGroup::getList();

        if ($this->request->isPost && $model->load($this->request->post())
            && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'type' => $model->type]);
        }

        return $this->render('update', [
            'model' => $model,
            'data'=>$data,
        ]);
    }

    /**
     * Deletes an existing Option model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $type 0-hotel,1-room type
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $type)
    {
        $this->findModel($id, $type)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Option model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $type 0-hotel,1-room type
     * @return Option the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $type)
    {
        if (($model = Option::findOne(['id' => $id, 'type' => $type])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
