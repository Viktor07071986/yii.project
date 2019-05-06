<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'All Posts';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-index">
	<h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'dd MMMM yyyy',
            'defaultTimeZone' => 'Europe/Kiev',
            'datetimeFormat' => 'php: d/m/Y H:i:s',
            'locale' => 'ru'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'login',
            'title',
            'content:ntext',
            //'datetimesendform',
            'datetimesendform:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
