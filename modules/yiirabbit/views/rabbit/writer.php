<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<p style="text-align: center;">
    <?= Html::a('reader', ['reader'], ['class' => 'btn btn-success', 'style' => 'margin-right: 50px;']) ?>
    <?= Html::a('writer', ['writer'], ['class' => 'btn btn-success']) ?>
</p>

<div class="form-create">
    <div class="form-form">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'date')->textInput([
            'readonly'=> true,
            'value' => date("d/m/Y H:i:s"),
        ]) ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>