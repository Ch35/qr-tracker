<?php

namespace service;

use page\auth;
use record\scanlog AS scanlog_record;
use record\qr AS qr_record;

class qr_form extends \interfaces\service{
    /**
     * @param array $params
     * @return array
     */
    protected function execute($params){
        global $CFG, $DB;

        // Validate and get the below data
        $userdevice = self::get_user_device();
        $ip = self::get_user_ip();

        list($location, $storename) = $this->validate_params($params);
        $qrid = auth::get_qrid_from_sesskey();

        if(empty($qrid)){
            throw new \Exception('Missing QR ID from session.');
        }

        if(isset($storename)){
            $record = new qr_record($qrid);
            $record->set_property('store_name', $storename);
            $updated = $record->update();

            if($updated === false){
                throw new \Exception('Failed to update storename');
                
            } elseif($updated === null){
                throw new \Exception('QR Record doesn\'t exist.');
            }
        }

        // only need to record one scanlog per session
        if(!scanlog_record::check_exists($_SESSION['sesskey'])){
            $scanlog = new scanlog_record(null, [
                'standid' => $qrid,
                'sesskey' => get_sesskey(),
                'location' => $location,
                'ip' => $ip,
                'device' => $userdevice,
                'timestamp' => $CFG->timestamp,
            ]);
    
            if(!$scanlog->insert()){
                throw new \Exception('Failed to insert scan log');
            }
        }

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

        if(isset($params['storename'])){
            $storename = $params['storename'];

            if(strlen($params['storename']) > 255){
                throw new \Exception('Store name exceded character limit');
            }

        } else{
            $storename = null;
        }

        return [
            $params['location'],
            $storename
        ];
    }

    private static function validate_location($location){
        // TODO:
        return true;
    }

    private static function get_user_ip(){
        // TODO: improve this approach
        $ip = $_SERVER['REMOTE_ADDR'];

        if(filter_var($ip, FILTER_VALIDATE_IP)){
            return $ip;
        }
        
        throw new \Exception('Invalid IP address');
    }

    /**
     * Fetches and validates user device
     *
     * @return string
     * @throws \Exception
     */
    private static function get_user_device(){
        if(empty($_SERVER['HTTP_USER_AGENT'])){
            throw new \Exception('skill issue :(', 401);
        }

        return $_SERVER['HTTP_USER_AGENT'];
    }
}