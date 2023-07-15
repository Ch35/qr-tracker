<?php
require __DIR__.'/../vendor/autoload.php';

session_start();

/**
 * @var renderer
 */
$GLOBALS['OUTPUT'] = new renderer();

/**
 * @var db
 */
$GLOBALS['DB'] = db::instance();