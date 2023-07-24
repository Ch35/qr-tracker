<?php

class db{
    private static $instance;

    private $db;

    private function __construct(){
        global $CFG;

        $this->db = new PDO("mysql:dbname=$CFG->dbname;host=$CFG->dbhost", $CFG->dbusername, $CFG->dbpassword);

        if($CFG->debugmode){
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
    }

    /**
     * @return self
     */
    static function instance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return string|false
     */
    function last_insert_id(){
        return $this->db->lastInsertId();
    }

    /**
     * @param string $sql
     * @param array $params
     * @param bool $return_statement
     * @return bool|PDOStatement
     */
    function execute($sql, $params = [], $return_statement = false){
        $statement = $this->db->prepare($sql);
        $execution = $statement->execute($params);

        return $return_statement ? $statement : $execution;
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