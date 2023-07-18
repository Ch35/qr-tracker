<?php

namespace interfaces;

abstract class service{
    private const SERVICE_NOT_FOUND = 404;

    /**
     * @param array $params
     * @return array|object
     */
    abstract protected function execute($params);

    /**
     * @param string $method
     * @param array|object $params
     * @return void
     */
    public static function init($method, $params = []){
        if(empty($method)){
            throw new \Exception('Method name required', self::SERVICE_NOT_FOUND);
        }

        $serviceclass = 'service\\'.$method;

        if(is_subclass_of($serviceclass, 'interfaces\\service')){
            $service = new $serviceclass();
            $service->respond($params);

        } else{
            throw new \Exception("Service[$method] not found", self::SERVICE_NOT_FOUND);
        }
    }

    protected function must_validate_sesskey(){
        return true;
    }

    public function respond($params){
        error_reporting(E_ERROR | E_PARSE);

        if($this->must_validate_sesskey() && !validate_sesskey()){
            throw new \Exception('Failed to validate session key', 'invalid_sesskey');
        }

        echo $this->encoding($this->execute($params));
    }

    public static function encoding($response){
        return json_encode($response);
    }
}