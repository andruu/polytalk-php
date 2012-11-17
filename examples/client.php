<?php
require __DIR__ . '/../vendor/autoload.php';

// Need to figure out how to autoload
require __DIR__ . '/../lib/Polytalk/Response.php';
require __DIR__ . '/../lib/Polytalk/Request.php';
require __DIR__ . '/../lib/Polytalk/Client.php';

$client  = new PolyTalk\Client(['port' => 9090]);
$client2  = new PolyTalk\Client(['port' => 9090]);

$request = [
    'class' => 'Model::Order',
    'method' => 'findBySize',
    'arguments' => [
        'size' => 'small',
        'limit' => 3
    ]
];

$request2 = [
    'class' => 'Model::Order',
    'method' => 'findBySize',
    'arguments' => [
        'size' => 'large',
        'limit' => 3
    ]
];

// Return response
$response = $client->call($request);
var_dump($response);

// Callback
$first_order = $client->call($request2, function ($response) {
  return $response[0];
});

var_dump($first_order);

// Return response
$response = $client2->call($request);
var_dump($response);

// Callback
$first_order = $client2->call($request2, function ($response) {
  return $response[0];
});

var_dump($first_order);