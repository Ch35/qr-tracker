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

    /**
     * @param int $id
     * @param array|object $properties
     */
    function __construct($id = null, $properties = null){
        self::check_table_implemented();

        if($id){
            $properties = self::get_record($id);

            if(empty($properties)){
                $classname = get_class($this);
                throw new \Exception("Missing $classname record from ID[$id]");
            }
        }

        // TODO: validate with all mapped DB columns
        $this->properties = (object)$properties;
        $this->table = static::TABLE;
    }

    function set_properties($properties){
        $this->properties = (object)array_merge((array)$this->properties, (array)$properties);
    }

    function set_property($property, $value){
        $this->properties->$property = $value;
    }

    function insert(){
        global $DB;

        if($this->exists() || empty($this->properties)){
            return;
        }

        $properties = (array)$this->properties;
        $keys = array_keys($properties);

        $columns = implode(',', $keys);
        $values = ':'.implode(',:', $keys);

        $sql = "INSERT INTO $this->table ($columns)
                VALUES ($values)";
        $success = $DB->execute($sql, $properties);

        if($success && $lastid = $DB->last_insert_id()){
            $this->properties->id = $lastid;
        }

        return $success;
    }

    function update(){
        global $DB;

        if(!$this->exists()){
            return;
        }

        $colset = '';
        foreach($this->properties AS $property => $value){
            $colset .= "$property = :$property,";
        }
        $colset = rtrim($colset, ',');

        $sql = "UPDATE $this->table
                SET $colset
                WHERE id = :id";

        return $DB->execute($sql, (array)$this->properties);
    }
    
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