<?php

namespace app\modules\yiirabbit\models;

use yii\db\ActiveRecord;

class Form extends ActiveRecord
{

    public static function tableName()
    {
        return 'form';
    }

    public function rules()
    {
        return [
            [['login', 'title', 'content'], 'required'],
            [['content'], 'string'],
            [['datetimesendform'], 'safe'],
            [['login', 'title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'title' => 'Title',
            'content' => 'Content',
            'datetimesendform' => 'Datetimesendform',
        ];
    }

}