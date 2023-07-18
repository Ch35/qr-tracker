<?php
require __DIR__.'/../config.php';

$method = get_param('method');
$params = json_decode(get_param('params'));

try{
    interfaces\service::init($method, $params);
    
} catch(Exception $e){
    // TODO: include $e->getTraceAsString when debugging is enabled
    echo interfaces\service::encoding([
        'error' => $e->getCode(),
        'message' => $e->getMessage(),
    ]);
}