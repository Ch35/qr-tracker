<?php

namespace service;

use page\auth;
use record\scanlog AS scanlog_record;
use record\qr AS qr_record;

class logout extends \interfaces\service{
    /**
     * @param array $params
     * @return array
     */
    protected function execute($params){
        $success = true;

        if(isset($_SESSION['sesskey'])){
            $success = session_destroy();
        }

        return ['success' => $success];
    }
}