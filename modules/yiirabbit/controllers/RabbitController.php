<?php

namespace app\modules\yiirabbit\controllers;

use app\modules\yiirabbit\models\RabbitReaderForm;
use app\modules\yiirabbit\models\RabbitWriterForm;
use yii\web\Controller;
use Yii;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitController extends Controller {

    public $connection;
    public $channel;
    public $queue;
    public $exchange;

    public function init() {
        $this->queue = "RabbitMQQueue";
        $this->exchange = "amq.direct";
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
        parent::init();
    }

    public function actionIndex () {
        return $this->render("rabbitmq");
    }

    public function actionReader () {
        $model = new RabbitReaderForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $rabbitForm = Yii::$app->request->post()["RabbitReaderForm"]["count_queue_message"];
            $sample = "<table border='1px solid black;' cellspacing='0' cellpadding='7' class='table table-striped'>
                        <tr>
                            <th>Логин</th>
                            <th>Заголовок сообщения</th>
                            <th>Сообщение</th>
                            <th>Время</th>
                        </tr>";
            for ($i = 0; $i < $rabbitForm; $i++) {
                $result = ($this->channel->basic_get('RabbitMQQueue', true, null)->body);
                $rez = json_decode($result, true);
                if (is_null($rez)) {
                    $sample .= "<h4>Доступных сообщений для выгрузки больше нет!</h4>";
                    break;
                } else {
                    $sample .= "<tr>
                        <td>".$rez["login"]."</td>
                        <td>".$rez["title"]."</td>
                        <td>".nl2br($rez["message"])."</td>
                        <td>".$rez["date"]."</td>
                    </tr>";
                }
            }
            $sample .= "</table>";
        }
        return $this->render("reader", compact('model', 'sample'));
    }

    public function actionWriter () {
        $model = new RabbitWriterForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $rabbitForm=Yii::$app->request->post();
            $rabbitForm = $rabbitForm["RabbitWriterForm"];
            $this->channel->queue_declare($this->queue, false, true, false, false);
            $this->channel->exchange_declare($this->exchange, AMQPExchangeType::DIRECT, false, true, false);
            $this->channel->queue_bind($this->queue, $this->exchange);
            $messageBody = json_encode($rabbitForm);
            $message = new AMQPMessage($messageBody, array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
            $this->channel->basic_publish($message, $this->exchange);
            $this->channel->close();
            $this->connection->close();
            return $this->redirect('writer');
        }
        return $this->render("writer", compact('model'));
    }

    public function __destruct() {
        // TODO: Implement __destruct() method. not working!!!
        //$this->channel->close();
        //$this->connection->close();
    }

}