<?php

/**
 * Validates whether a session key is valid
 *
 * @return bool
 */
function validate_sesskey(){
    return isset($_SESSION['sesskey']);
}

/**
 * @return string|false
 */
function get_sesskey(){
    if(!validate_sesskey()){
        return false;
    }

    return $_SESSION['sesskey'];
}

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

/**
 * Used strictly for testing
 *
 * @param mixed $var
 * @return void
 */
function print_clean($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}