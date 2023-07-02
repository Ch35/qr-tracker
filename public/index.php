<?php
require __DIR__.'/../config.php';

// // TODO: maybe group by $_GET['dispatchid']

// // TODO: query as group - add another field to group by
// $stands = $DB->query('SELECT * FROM qr_stands');

// foreach($stands AS $stand){
//     // TODO: generate QR codes
//     // TODO: convert to PDF
//     // TODO: save as file
//     // TODO: zip file
//     // TODO: serve zip file to user
// }

$qrid = isset($_GET['qrid']) ? $_GET['qrid'] : null;

$template = isset($qrid) ? 'form' : 'auth';

$header = $template == 'auth' ? 'Authorization' : 'Stand ID '.$qrid;

$tpl = $RENDERER->loadTemplate($template);
echo $tpl->render([
    'title' => 'Test',
    'header' => $header,
    'cfg' => $CFG
]);