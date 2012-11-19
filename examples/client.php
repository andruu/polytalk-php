<?php
require __DIR__ . '/../vendor/autoload.php';

// Need to figure out how to autoload
require __DIR__ . '/../lib/Polytalk/Response.php';
require __DIR__ . '/../lib/Polytalk/Request.php';
require __DIR__ . '/../lib/Polytalk/Client.php';

$client  = new Polytalk\Client(['port' => 9090]);

$request = [
    'class' => 'Model::Order',
    'method' => 'findBySize',
    'arguments' => [
        'size' => 'small',
        'limit' => 3
    ]
];

// Return response
$response = $client->call($request);
var_dump($response);

// Callback
$first_order = $client->call($request, function ($response) {
  return $response[0];
});
var_dump($first_order);


$request2 = [
    'class' => 'Test',
    'method' => 'add',
    'arguments' => [
        'a' => 3,
        'b' => 2
    ]
];

$request3 = [
    'class' => 'Test',
    'method' => 'shout',
    'arguments' => [
        'words' => 'hello how are you doing?'
    ]
];

// Return response
$response = $client->call($request);
var_dump($response);

// Callback
$first_order = $client->call($request, function ($response) {
  return $response[0];
});

var_dump($first_order);

echo $client->call($request2), "\n";
echo $client->call($request3), "\n";



