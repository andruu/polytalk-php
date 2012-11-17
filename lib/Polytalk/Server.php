<?php
/*
 * This file is part of the Polytalk package.
 *
 * (c) Andrew Weir <andru.weir@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Polytalk;

use Polytalk\Request;
use Polytalk\Response;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

class Server {

  private $port = 9090;
  private $host = '127.0.0.1';

  public function __construct ($config = []) {
    if (!empty($config['port'])) {
      $this->port = $config['port'];
    }

    if (!empty($config['host'])) {
      $this->host = $config['host'];
    }
  }

  public function run ($callback) {
    $loop   = \React\EventLoop\Factory::create();
    $socket = new \React\Socket\Server($loop);

    $socket->on('connection', function ($connection) use ($callback) {
      $connection->on('data', function ($request) use ($connection, $callback) {
        $log = new Logger('name');
        $log->pushHandler(new RotatingFileHandler('tmp/info.log', Logger::INFO));
        $log->addInfo($request);
        call_user_func($callback, $connection, new Request($request));
      });
    });
    $socket->listen($this->port);
    $loop->run();
  }

  public function call (Request $request) {
    $_request = $request->toArray();
    $class = str_replace('::', '\\', $_request['class']);
    $response = call_user_func_array([$class, $_request['method']], $_request['arguments']);
    return new Response($response);
  }

  public function push (\React\Socket\Connection $connection, Response $response) {
    $connection->write($response->toJSON());
    $connection->end();
  }

}