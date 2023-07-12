<?php

class qr_record{
    /**
     * @param [type] $id
     * @param string $properties
     * @return array|null
     */
    static function get_record($id, $properties = '*'){
        global $DB;

        $sql = "SELECT $properties
                FROM qr_stands
                WHERE id = :id";
        
        return $DB->get_record($sql, ['id' => $id]);
    }
}