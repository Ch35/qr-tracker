<?php
require __DIR__.'/../config.php';

$password = get_param('authtoken');

if($password){
    setcookie('authentication', '1');
}

echo $OUTPUT->render('auth');