<?php
require __DIR__.'/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$input = json_decode(file_get_contents('php://input'));

if(!isset($input->method)){
    throw new Exception('Missing required parameters');
}

$method = $input->method;
$params = isset($input->params) ? (array)$input->params : [];

try{
    interfaces\service::init($method, $params);
    
} catch(Exception $e){
    header('HTTP/1.1 400 Bad Request');

    // TODO: include $e->getTraceAsString when debugging is enabled
    echo interfaces\service::encoding([
        'error' => $e->getCode(),
        'message' => $e->getMessage(),
    ]);
}