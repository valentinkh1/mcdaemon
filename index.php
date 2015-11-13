<?php


//C:\wamp\bin\php\php5.5.12\php.exe

require 'engine/autoloader.php';

$avtoloader = Autoloader::init();
$paths = array(
    'app/libs',
    'app/controllers',
);
$avtoloader->load($paths);
///
require 'vendor/autoload.php';

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket);
///
$queue = new queueHandler();
///
$http->on('request', function ($request, $response) {
    $answer = 'void';


    $query = $request->getQuery();
    $path = $request->getPath();

    $dispatcher = Dispatcher::getInstance();
    $answer =  $dispatcher->run($query,$path);

    if (isset($query['param'])) { 

        if ($query['param'] == 'time') {
            $answer = microtime(true);
        }
        if ($query['param'] == 'die') {
            echo 'Die';
            exit;
        }
    }

    $response->writeHead(200, array('Content-Type' => 'text/plain'));
    $response->end($answer);
});

$socket->listen(1337);
$loop->run();