<?php

namespace interfaces;

use Exception;

// TODO: if have session key - implement logout button!

abstract class page{
    private static $instances = [];

    const ALERT_WARNING = 0;
    const ALERT_SUCCESS = 1;

    protected const ALERT_TYPES = [
        self::ALERT_WARNING => 'warning', 
        self::ALERT_SUCCESS => 'success',
    ];

    protected $config;
    protected $pagesetup;

    /**
     * Singletons should not be cloneable.
     */
    protected function __clone() {}

    /**
     * Singletons should not be restorable from strings.
     * @throws Exception
     */
    public function __wakeup(){
        throw new Exception("Cannot unserialize a singleton.");
    }

    /**
     * Singletons should not be callable.
     */
    private function __construct(){}

    /**
     * @param array $config
     * @return array
     */
    protected function init_config() : array{
        return [];
    }

    /**
     * Whether to route to a different page
     *
     * @return bool|page
     */
    protected abstract function route_request();

    public static function init() : self{
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        if($routed = self::$instances[$cls]->route_request()){
            return $routed;
        }

        return self::$instances[$cls];
    }

    /**
     * Render the page from the template (class name)
     *
     * @return void
     */
    public function render(){
        global $OUTPUT;

        $this->config = $this->init_config();

        list($namespace, $template) = explode('\\', get_class($this));
        echo $OUTPUT->render($template, $this->config, $this->pagesetup);
    }

    /**
     * Adds JS file to be loaded from the HTML head
     *
     * @param string $file
     * @return void
     */
    protected function loadjs($file){
        $this->pagesetup['js'][] = $file;
    }

    /**
     * Helper method to append alerts on the page
     *
     * @param string $text
     * @param int $alerttype
     * @return void
     * 
     * @throws \Exception
     */
    protected function append_alert($text, $alerttype){
        if(!isset(array_keys(self::ALERT_TYPES)[$alerttype])){
            throw new Exception('Invalid alert type');
        }

        $this->pagesetup['alerts'][self::ALERT_TYPES[$alerttype]][] = $text;
    }
}