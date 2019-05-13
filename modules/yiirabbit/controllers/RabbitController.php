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

    public function actionIndex () {
        return $this->render("rabbitmq");
    }

    public function actionReader () {
        $model = new RabbitReaderForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
            $channel = $connection->channel();
            $rabbitForm = Yii::$app->request->post()["RabbitReaderForm"]["count_queue_message"];
            $sample = "<table border='1px solid black;' cellspacing='0' cellpadding='7' class='table table-striped'>
                        <tr>
                            <th>Логин</th>
                            <th>Заголовок сообщения</th>
                            <th>Сообщение</th>
                            <th>Время</th>
                        </tr>";
            for ($i = 0; $i < $rabbitForm; $i++) {
                $result = ($channel->basic_get('RabbitMQQueue', true, null)->body);
                $rez = json_decode($result, true);
                if (is_null($rez)) {
                    $sample .= "<hr/>Доступных сообщений для выгрузки больше нет!";
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
            $queue = "RabbitMQQueue";
            $exchange = "amq.direct";
            $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest', '/', false, 'AMQPLAIN', null, 'en_US', 30);
            $channel = $connection->channel();
            $channel->queue_declare($queue, false, true, false, false);
            $channel->exchange_declare($exchange, AMQPExchangeType::DIRECT, false, true, false);
            $channel->queue_bind($queue, $exchange);
            $messageBody = json_encode($rabbitForm);
            $message = new AMQPMessage($messageBody, array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
            $channel->basic_publish($message, $exchange);
            $channel->close();
            $connection->close();
            return $this->redirect('writer');
        }
        return $this->render("writer", compact('model'));
    }

}