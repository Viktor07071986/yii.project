<?php

namespace app\modules\yiirabbit\models;

use yii\base\Model;

class RabbitReaderForm extends Model
{

    public $count_queue_message;

    public function rules()
    {
        return [
            [['count_queue_message'], 'required'],
            [['count_queue_message'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'count_queue_message' => 'Count queue message',
        ];
    }

}