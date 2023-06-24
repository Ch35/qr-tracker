<?php
$GLOBALS['CFG'] = (object)[
    'wwwroot' => 'http://localhost/grtracker',
    'timestamp' => time(),
    'dbhost' => 'localhost',
    'dbusername' => 'root',
    'dbpassword' => '',
    'dbname' => 'qrtracker',
];

require __DIR__.'/lib/setup.php';