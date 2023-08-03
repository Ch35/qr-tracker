<?php

namespace record;

use interfaces\record;

class scanlog extends record{
    protected const TABLE = 'qr_scanlogs';

    /**
     * We only really need one scanlog for each unique sesskey
     *
     * @param string $sesskey
     * @return bool
     */
    public static function check_exists($sesskey){
        global $DB;

        $table = self::TABLE;
        $sql = "SELECT id
                FROM {$table}
                WHERE sesskey = :sesskey";
        $r = $DB->get_record($sql, ['sesskey' => $sesskey]);

        return !empty($r);
    }
}