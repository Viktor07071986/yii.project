<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Update Post: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'All Posts', 'url' => ['all']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="form-update">
	<h1><?= Html::encode($this->title) ?></h1>
    <div class="form-form">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'datetimesendform')->textInput([
            'readonly'=> true,
            //'value' => Yii::$app->formatter->asDatetime($model->update('php:d/m/Y H:i:s')),
            //'value' => Yii::$app->formatter->asDatetime($model->datetimesendform, 'php:d/m/Y H:i:s'),
        ]) ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>