<?php

abstract class page_interface{
    private $template;
    private $config = [];

    public function render(){
        global $OUTPUT;

        if(empty($this->template)){
            throw new Exception('Please set page renderer template');
        }

        echo $OUTPUT->render($this->template, $this->config);
    }
}