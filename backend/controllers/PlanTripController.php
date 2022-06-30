<?php

namespace backend\controllers;

use backend\models\PlanTrip;
use backend\models\PlanTripLang;
use backend\models\PlanTripQuery;
use backend\models\PlanTripSearch;
use yii\web\NotFoundHttpException;

class PlanTripController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new PlanTripSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' =>$searchModel ,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlanTrip model.
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
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlanTrip();

        $data['en']['note'] = "";
        $data['ru']['note'] = "";
        $data['fr']['note'] = "";

        if ($this->request->isPost) {
            $post = $this->request->post();
            if ($model->load($this->request->post()) && $model->save()) {



                $note = new PlanTripLang();
                $note->id = $model->id;
                $note->lang = 'ru';
                $note->note = trim($post['note_ru']);
                $note->save();

                $note = new PlanTripLang();
                $note->id = $model->id;
                $note->lang = 'fr';
                $note->note = trim($post['note_fr']);
                $note->save();

                $note = new PlanTripLang();
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

        $data['en'] = PlanTripLang::find()->where(['id' => $id,'lang'=>'en'])->one();
        $data['ru'] = PlanTripLang::find()->where(['id' => $id,'lang'=>'ru'])->one();
        $data['fr'] = PlanTripLang::find()->where(['id' => $id,'lang'=>'fr'])->one();

        if($data['en'] == null){
            $data['en'] =  new PlanTripLang();
            $data['en']['id']= $id;
            $data['en']['lang']= 'en';
            $data['en']['note']= null;
        }

        if($data['ru'] == null){
            $data['ru'] =  new PlanTripLang();
            $data['ru']['id']= $id;
            $data['ru']['lang']= 'ru';
            $data['ru']['note']= null;
        }

        if($data['fr'] == null){
            $data['fr'] =  new PlanTripLang();
            $data['fr']['id']= $id;
            $data['fr']['lang']= 'fr';
            $data['fr']['note']= null;
        }

        if ($this->request->isPost) {
            $post = $this->request->post();
            if ($model->load($this->request->post()))
            {
                if ($model->save()) {

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
     * @return PlanTrip the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlanTrip::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
