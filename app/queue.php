<?php

require_once __DIR__.'/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$queue_name = 'bob.orders';

$data_json = "{'id': 100, 'description': 'bla blu ble', 'date': '2022-03-08'}";

$channel->queue_declare($queue_name, false, false, false, false);

$msg = new AMQPMessage($data_json);
$channel->basic_publish($msg, '', $queue_name);

echo " [x] Sent '" . $data_json . "'\n";

$channel->close();
$connection->close();
?>