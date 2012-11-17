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

class Client {

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

  public function call ($request, $callback = null) {
    $loop       = \React\EventLoop\Factory::create();
    $client     = stream_socket_client("tcp://{$this->host}:{$this->port}");
    $connection = new \React\Socket\Connection($client, $loop);

    $request = new Request($request);
    $connection->write($request->toJSON());
    
    $response = null;
    $connection->on('data', function ($data) use ($callback, &$response) {
      $response = $data;
    });

    $loop->run();

    if ($callback) {
      return call_user_func($callback, $this->getResponse($response)->toArray());
    } else {
      return $this->getResponse($response)->toArray();
    }
  }

  public function getResponse ($response) {
    return new Response($response);
  }
  
}