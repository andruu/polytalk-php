<?php
require __DIR__ . '/../vendor/autoload.php';

// Need to figure out how to autoload
require __DIR__ . '/../lib/Polytalk/Response.php';
require __DIR__ . '/../lib/Polytalk/Request.php';
require __DIR__ . '/../lib/Polytalk/Server.php';

// Mock Model
require __DIR__ . '/Model/Order.php';

class Test {
  public static function add ($a, $b) {
    return $a + $b;
  }

  public static function shout ($words) {
    return strtoupper($words);
  }
}

$server = new Polytalk\Server(['port' => 9090]);
$server->run(function ($connection, $request) use ($server) {
  $response = $server->call($request);
  $server->push($connection, $response);
});