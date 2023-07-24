<?php
require __DIR__.'/../config.php';

$input = json_decode(file_get_contents('php://input'));

if(!isset($input->method) || !isset($input->params)){
    throw new Exception('Missing required parameters');
}

// TODO: may need to get sesskey from here
$method = $input->method;
$params = (array)$input->params;

try{
    interfaces\service::init($method, $params);
    
} catch(Exception $e){
    // TODO: include $e->getTraceAsString when debugging is enabled
    echo interfaces\service::encoding([
        'error' => $e->getCode(),
        'message' => $e->getMessage(),
    ]);
}