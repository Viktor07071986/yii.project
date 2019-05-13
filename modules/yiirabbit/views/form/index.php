<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-create">
	<h1><?= Html::encode($this->title) ?></h1>
    <div class="form-form">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
        <? /* = $form->field($model, 'datetimesendform')->textInput() */ ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Посмотреть все', ['all'], ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>