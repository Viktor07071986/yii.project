<?php

namespace app\modules\yiirabbit\controllers;

use Yii;
use yii\web\Controller;
use app\modules\yiirabbit\models\Form;
use yii\data\ActiveDataProvider;

class FormController extends Controller
{

    public function actionIndex ()
    {

        $model = new Form();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/');
        }

        return $this->render('index', compact('model'));
    }

    public function actionAll ()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Form::find(),
        ]);
        return $this->render('all', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete ($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['all']);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Form::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}