<?php

/**
 * @param string $name
 * @param mixed $default
 * @param int $filtertype
 * @return mixed
 */
function get_param($name, $default = null, $filtertype = FILTER_DEFAULT){
    if(isset($_GET[$name])){
        return filter_input(INPUT_GET, $name, $filtertype);
    }

    if(isset($_POST[$name])){
        return filter_input(INPUT_POST, $name, $filtertype);
    }

    return $default;
}

function print_clean($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}