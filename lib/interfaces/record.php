<?php

namespace interfaces;

use Exception;

abstract class record{
    protected const TABLE = '';
    protected $properties;
    protected $table;

    /**
     * @param int $id
     * @param string $properties
     * @return array|null
     */
    static function get_record($id, $properties = '*'){
        global $DB;

        self::check_table_implemented();

        $table = static::TABLE;
        $sql = "SELECT $properties
                FROM $table
                WHERE id = :id";

        return $DB->get_record($sql, ['id' => $id]);
    }

    function __construct($properties = null){
        self::check_table_implemented();

        $this->properties = (object)$properties;
        $this->table = static::TABLE;
    }

    function set_property($property, $value){
        $this->properties->$property = $value;
    }

    // TODO: test
    function insert(){
        global $DB;

        if($this->exists()){
            return;
        }

        $properties = (array)$this->properties;

        $columns = implode(',', array_keys($properties));
        $values = ':'.implode(',:', $properties);

        $sql = "INSERT INTO $this->table ($columns)
                VALUES ($values)";
        return $DB->execute($sql, $properties);
    }

    // TODO: test
    function update(){
        global $DB;

        if(!$this->exists()){
            return;
        }

        // TODO:
        $sql = 'UPDATE';

        return $DB->execute($sql, [
            'id' => $this->properties->id
        ]);
    }

    // TODO: test
    function delete(){
        global $DB;

        if(!$this->has_id()){
            return false;
        }

        $sql = "DELETE 
                FROM $this->table
                WHERE id = :id";

        return $DB->execute($sql, [
            'id' => $this->properties->id
        ]);
    }

    protected function exists(){
        global $DB;

        if(!$this->has_id()){
            return false;
        }

        $sql = "SELECT id
                FROM $this->table
                WHERE id = :id";

        $statement = $DB->execute($sql, [
            'id' => $this->properties->id
        ], true);

        return (bool)$statement->fetchColumn();
    }

    protected function has_id(){
        return isset($this->properties->id);
    }

    protected static function check_table_implemented(){
        if(empty(static::TABLE)){
            throw new Exception('Child class must implement TABLE const');
        }
    }
}