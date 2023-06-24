<?php
require __DIR__.'/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

$mustache = new Mustache_Engine([
    'cache' => dirname(__FILE__).'/..//tmp/cache/mustache', // TODO: update based on config
    'cache_file_mode' => 0666, // TODO: may need to update this on the server (umask)
    'cache_lambda_templates' => true,
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/../templates'),
    // 'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/views/partials'),
    // 'helpers' => array('i18n' => function($text) {
    //     // do something translatey here...
    // }),
    // 'escape' => function($value) {
    //     return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
    // },
    // 'charset' => 'ISO-8859-1',
    // 'logger' => new Mustache_Logger_StreamLogger('php://stderr'),
    // 'strict_callables' => true,
    // 'pragmas' => [Mustache_Engine::PRAGMA_FILTERS],
]);

$GLOBALS['RENDERER'] = $mustache;

$db = new mysqli($CFG->dbhost, $CFG->dbusername, $CFG->dbpassword, $CFG->dbname);

$GLOBALS['DB'] = $db;