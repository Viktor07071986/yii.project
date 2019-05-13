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
        <?= $form->field($model, 'count_queue_message')->textInput(['maxlength' => true]) ?>
        <div class="form-group">
            <?= Html::submitButton('Touch', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<p>
    <?php
        echo $sample;
    ?>
</p>
