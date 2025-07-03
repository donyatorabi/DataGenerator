<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    protected $connection;
    protected $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST', '127.0.0.1'),
            env('RABBITMQ_PORT', 5672),
            env('RABBITMQ_USER', 'guest'),
            env('RABBITMQ_PASSWORD', 'guest')
        );

        $this->channel = $this->connection->channel();

        $this->channel->queue_declare(
            env('RABBITMQ_QUEUE', 'task_queue'),
            false,
            true,
            false,
            false
        );
    }

    public function publish($data)
    {
        $messageBody = json_encode($data);
        $message = new AMQPMessage($messageBody, [
            'delivery_mode' => 2
        ]);

        $this->channel->basic_publish(
            $message,
            '',
            env('RABBITMQ_QUEUE', 'rabbitmq')
        );
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
