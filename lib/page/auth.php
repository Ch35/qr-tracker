<?php

namespace page;

class auth extends \page_interface{
    private const PASSWORD = 'keanu is stinky';

    function route_request(){
        global $DB;

        // TODO: check if location is enabled

        $authenticated = false;
        $authtoken = get_param('authtoken');
        $qrid = get_param('qrid');

        if($authtoken){
            // TODO: check if QR record exists
    
            $authenticated = $authtoken === self::PASSWORD;
    
            if(!$authenticated){
                $this->append_alert('Invalid Password. Please try again.', self::ALERT_WARNING);
                http_response_code(401);
            }
        }


        // TODO: once authenticated save as cookie

        return $authenticated ? form::init() : false;
    }

    /**
     * @param array $config
     * @return array
     */
    function init_config() : array{
        return [];
    }
}