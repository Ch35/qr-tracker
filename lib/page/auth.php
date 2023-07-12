<?php

namespace page;

use qr_record;

class auth extends \page_interface{
    function route_request(){
        $authenticated = false;
        $authtoken = get_param('authtoken');
        $qrid = (int)get_param('qrid', null, FILTER_SANITIZE_NUMBER_INT);

        $qr_record = empty($qrid) ? false : qr_record::get_record($qrid);

        // We've already authenticated
        if(isset($_SESSION['sesskey'])){
            return $this->validate_sesskey($_SESSION['sesskey'], $qr_record);
        }

        if($qrid === false){
            $this->append_alert('Missing QR ID. Please try scanning again.', self::ALERT_WARNING);
            http_response_code(401);
        }

        if($authtoken){
            // check if QR record exists
            if(empty($qr_record)){
                $this->append_alert('Invalid QR ID. Please try scanning again.', self::ALERT_WARNING);
                http_response_code(401);
                return false;
            }

            // TODO: Password needs to be a map between the distribution centres
            $password = '123';
    
            $authenticated = $authtoken == $password;
    
            if(!$authenticated){
                $this->append_alert('Invalid Password. Please try again.', self::ALERT_WARNING);
                http_response_code(401);
                return false;
            }
        }

        if($authenticated){
            if(!self::create_sesskey($qrid)){
                $this->append_alert('Failed to save session key. You may need to re-authenticate on page load.', self::ALERT_WARNING);
            }
        }

        return $authenticated ? form::init() : false;
    }

    /**
     * @param array $config
     * @return array
     */
    function init_config() : array{
        return [];
    }

    /**
     * @param string $key
     * @param array $requested_qrid
     * @return bool|
     */
    private function validate_sesskey($key, $requested_qr_record = null){
        list($qrid, $timestamp) = explode('_', $key);
        $qr_record = qr_record::get_record($qrid);

        if(empty($qr_record)){
            $this->append_alert('Internal Server Error', self::ALERT_WARNING);
            http_response_code(401);

            return $this;
        }

        if(isset($requested_qr_record)){
            if(empty($requested_qr_record)){
                $this->append_alert('Requested QR record not found. Please try scanning again.', self::ALERT_WARNING);
                http_response_code(401);

                return $this;

            } else{
                // Do not allow authentication between distributions
                if($requested_qr_record['distribution_id'] !== $qr_record['distribution_id']){
                    $this->append_alert('Unable to authenticate to separate distribution group. Please authenticate again.', self::ALERT_WARNING);
                    unset($_SESSION['sesskey']);

                    http_response_code(401);
                    return $this;
                }
            }
        }

        return $qr_record ? form::init() : $this;
    }

    /**
     * @param int $qrid
     * @return bool
     */
    private static function create_sesskey($qrid){
        global $CFG;

        $_SESSION['sesskey'] = $qrid.'_'.$CFG->timestamp;
    }
}