<?php

namespace service;

use record\scanlog AS scanlog_record;

class qr_form extends \interfaces\service{
    protected function execute($params){
        global $CFG;

        list($location, $storename) = $this->validate_params($params);

        $scanlog = new scanlog_record([
            'standid' => '', // TODO: get stand/QR ID
            'ip' => '', // TODO: get user IP
            'device' => '', // TODO: get user device
            'timestamp' => $CFG->timestamp,
        ]);

        if(!$scanlog->insert()){
            throw new \Exception('Failed to insert scan log');
        }

        // TODO: if storename is included - update it in the DB

        return $params;
    }

    private function validate_params($params){
        if(empty($params)){
            throw new \Exception('Invalid QR service params');
        }

        if(!isset($params['location'])){
            throw new \Exception('Your location is required');

        } else if(!self::validate_location($params['location'])){
            throw new \Exception('Failed to validate device location');
        }

        // TODO: do additional optional checks for store name updates
    }

    private static function validate_location($location){
        // TODO:
    }
}