<?php
require __DIR__.'/../vendor/autoload.php';

session_start();

/**
 * @var renderer
 */
$GLOBALS['OUTPUT'] = new renderer();

/**
 * @var mysqli
 */
$GLOBALS['DB'] = db::instance();