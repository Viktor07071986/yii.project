<?php

namespace app\modules\yiirabbit\models;

use yii\base\Model;

class RabbitWriterForm extends Model
{

    public $login;
    public $title;
    public $message;
    public $date;

    public function rules()
    {
        return [
            [['login', 'title', 'message'], 'required'],
            [['message'], 'string'],
            [['date'], 'safe'],
            [['login', 'title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Login',
            'title' => 'Title',
            'content' => 'Content',
            'date' => 'Date',
        ];
    }

}