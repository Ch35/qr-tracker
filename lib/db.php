<?php

class db{
    private static $instance;

    private $db;

    private function __construct(){
        global $CFG;

        $this->db = new PDO("mysql:dbname=$CFG->dbname;host=$CFG->dbhost", $CFG->dbusername, $CFG->dbpassword);
    }

    static function instance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array[array]|false
     */
    function get_records($sql, $params = []){
        $statement = $this->db->prepare($sql);
        $statement->execute($params);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array|false
     */
    function get_record($sql, $params = []){
        $records = $this->get_records($sql, $params);

        return reset($records);
    }
}