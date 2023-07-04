<?php
require __DIR__.'/../vendor/autoload.php';

$GLOBALS['OUTPUT'] = new renderer();
$GLOBALS['DB'] = new mysqli($CFG->dbhost, $CFG->dbusername, $CFG->dbpassword, $CFG->dbname);