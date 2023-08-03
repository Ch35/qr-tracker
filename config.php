<?php
$cache_enabled = true;
$browser_cache_enabled = false;
$timestamp = time();

$GLOBALS['CFG'] = (object)[
    'wwwroot' => 'http://localhost/grtracker',
    'browser_cache_enabled' => $browser_cache_enabled,
    'cache_enabled' => $cache_enabled,
    'timestamp' => time(),
    'cache_ver' => $browser_cache_enabled ? '1' : $timestamp,
    'dbhost' => 'localhost',
    'dbusername' => 'root',
    'dbpassword' => '',
    'dbname' => 'qrtracker',
    'title' => 'Simba QR Tracker',
    'globalpassword' => '123',
    'debugmode' => true
];

$CFG->partialroot = parse_url($CFG->wwwroot)['path'];

require __DIR__.'/lib/setup.php';