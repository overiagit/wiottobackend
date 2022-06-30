<?php

namespace backend\controllers;

use yii\web\Controller;

class oldBestForYouController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index', [
            'model' => "BestForYouController",
        ]);
    }

}