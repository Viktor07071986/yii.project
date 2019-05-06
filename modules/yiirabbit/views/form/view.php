<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'All Posts', 'url' => ['all']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="form-view">
	<h1><?= Html::encode($this->title) ?></h1>
	<p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'dd MMMM yyyy',
            'defaultTimeZone' => 'Europe/Kiev',
            'datetimeFormat' => 'php: d/m/Y H:i:s',
            'locale' => 'ru'
        ],
        'attributes' => [
            'id',
            'login',
            'title',
            'content:ntext',
            //'datetimesendform',
            'datetimesendform:datetime',
        ],
    ]) ?>
</div>