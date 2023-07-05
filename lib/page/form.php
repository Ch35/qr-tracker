<?php

namespace page;

class form extends \page_interface{
    function route_request(){
        return false;
    }

    /**
     * @param array $config
     * @return array
     */
    function init_config() : array{
        return [];
    }
}