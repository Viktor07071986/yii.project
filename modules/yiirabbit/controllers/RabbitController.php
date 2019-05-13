<?php

namespace app\modules\yiirabbit\controllers;

use yii\web\Controller;

class RabbitController extends Controller
{

    public function actionIndex ()
    {
        return $this->render("rabbitmq");
    }

    public function actionReader ()
    {
        return $this->render("reader");
    }

    public function actionWriter ()
    {
        return $this->render("writer");
    }

}