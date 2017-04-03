<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "root";
$config['db']['dbname'] = "api";

$app = new \Slim\App(["settings" => $config]);

$app->get('/agents', function (Request $request, Response $response) {
  
    $data = [
    	'agents' => [
    		'Antanas Jonatis' => [
    			'id' => '1',
    			'username'	=> 'antjnt',
    			'created'	=> '2017-01-01'
    		],
    		'Jonas Jonatis' => [
    			'id' => '2',
    			'username'	=> 'jnsjnt',
    			'created'	=> '2017-01-01'
    		]
    	]
    ];

	echo json_encode($data);
});

$app->get('/agents/getAgent/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    

    $data = [
    	'agent' => [
    		'Antanas Jonatis' => [
    			'id' => $id,
    			'username'	=> 'antjnt',
    			'created'	=> '2017-01-01'
    		]
    	]
    ];

	echo json_encode($data);
});

$app->post('/agents/updateAgent', function (Request $request, Response $response) {
    
    $data = $request->getParsedBody();
    
    $agent_data = [];
    $agent_data['id'] = filter_var($data['id'], FILTER_SANITIZE_STRING);
    $agent_data['username'] = filter_var($data['username'], FILTER_SANITIZE_STRING);

    // ...

    $result = [
    	"statusCode"	=>	200,
    	'message'	=> 'Agent updated successfully'
    ];

    echo json_encode($result);
    
});

$app->run();