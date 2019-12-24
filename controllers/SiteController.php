<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionError()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $exception = Yii::$app->errorHandler->exception;

        return (array) $exception;
    }
}
