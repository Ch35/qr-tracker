<?php

namespace page;

use interfaces\page;

class form extends page{
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