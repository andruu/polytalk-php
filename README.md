# Polytalk

Polytalk is a simple protocol which allows communication between different languages via TCP.

Polytalk currently supports PHP, Node.js and Ruby.

## Protocol

The protocol is a simple language agnostic JSON object containing the channel, class, method and arguments. It will then return an response as either a string or JSON object.

Key          | Value
------------ | ------------- 
class        | The class to call the method on. Namespaced classes require the `::` separator.
method       | The method you want to call.
arguments    | The arguments to inject into the method in key value pairs.

## Installation

The recommended way to install Polytalk is [through composer](http://getcomposer.org/).

```javascript
{
	"require": {
   		"polytalk/polytalk": "dev-master"
   	}
}
```
    
## Server Example

```php
$server = new Polytalk\Server(['port' => 9090]);
$server->run(function ($connection, $request) use ($server) {
  $response = $server->call($request);
  $server->push($connection, $response);
});
```

## Client Example
	
```php
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
```

### License

MIT, see LICENSE.