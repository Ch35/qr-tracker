<?php

namespace page;

use record\qr AS qr_record;
use record\distribution AS distribution_record;
use interfaces\page;

class form extends page{
    function route_request(){
        $this->loadjs('form');

        return false;
    }

    /**
     * @param array $config
     * @return array
     */
    function init_config() : array{
        // TODO: load storename and distribution name
        $qrid = auth::get_qrid_from_sesskey();

        if(empty($qrid)){
            throw new \Exception('Missing QR ID from session.');
        }

        $qr_record = new qr_record($qrid);
        $dist_record = new distribution_record($qr_record->get_property('distribution_id'));

        return [
            'store_name' => $qr_record->get_property('store_name'),
            'distribution_name' => $dist_record->get_property('name'),
        ];
    }
}