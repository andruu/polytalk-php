# Polytalk

Polytalk is a simple protocol which allows communication between different languages.

Polytalk currently supports PHP, Node.js and Ruby.

## Installation

The recommended way to install Polytalk is [through composer](http://getcomposer.org/).

	"require": {
      "polytalk/polytalk": "dev-master"
    }
    
## Server Example

	$server = new Polytalk\Server(['port' => 9090]);
	$server->run(function ($connection, $request) use ($server) {
	  $response = $server->call($request);
	  $server->push($connection, $response);
	});

## Client Example

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

### License

MIT, see LICENSE.