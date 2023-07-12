<?php
require __DIR__.'/../config.php';

$method = get_param('method');
$params = json_decode(get_param('params'));

// TODO: execute ajax method