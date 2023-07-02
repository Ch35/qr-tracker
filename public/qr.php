<?php
require __DIR__.'/../config.php';
require __DIR__.'/../lib/QRImageWithText.php';
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Mpdf\Mpdf;

$sql = 'SELECT qs.id, qs.distribution_id, qd.name AS distribution, qd.contact_person
		FROM qr_stands qs
		LEFT JOIN qr_distributions qd ON qd.id = qs.distribution_id';
$standlist = $DB->query($sql);
$datarooturl = 'qr-tracking-solutions.co.za?qrid=';

$qr_options = new QROptions([
	'version'      => 7,
	'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
	'scale'        => 3,
	'imageBase64'  => false,
]);

$imgpath_root = __DIR__.'/../QRCodes/';

foreach($standlist AS $stand){
	$qrcode = new QRImageWithText($qr_options, (new QRCode($qr_options))->getMatrix($datarooturl.$stand['id']));
	
	$distribution = $stand['distribution'].'-'.$stand['distribution_id'].'-'.$stand['contact_person'];

	$img = $qrcode->dump(null, 'TT'.$stand['id']);
	$imgname = 'TT'.$stand['id'];

	$distributionroot = $imgpath_root.$distribution.'/';

	if(!file_exists($distributionroot)){
		mkdir($distributionroot, 0777);
	}

	$imgpath = $distributionroot.$imgname.'.png';

	// Save image
	file_put_contents($imgpath, $img);

	$size =  getimagesizefromstring($img);
	$width = $size[0];
	$height = $size[1];
	$mpdf = new Mpdf();
	$mpdf->WriteHTML('');
	$mpdf->Image($imgpath,0,0,$width,$height,'png','',true, true);
	$mpdf->Output($imgpath.$imgname.'.pdf', \Mpdf\Output\Destination::FILE);
}

// $data = 'qr-tracking-solutions.co.za?qrid=25'.time();

// $options = new QROptions([
// 	'version'      => 7,
// 	'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
// 	'scale'        => 3,
// 	'imageBase64'  => false,
// ]);

// $qrOutputInterface = new QRImageWithText($options, (new QRCode($options))->getMatrix($data));

// $img = $qrOutputInterface->dump(null, 'TT1');
// $imgpath = __DIR__.'/../QRCodes/test.png';

// var_dump(file_put_contents($imgpath, $img));

// $size =  getimagesizefromstring($img);
// $width = $size[0];
// $height = $size[1];
// $mpdf = new Mpdf();
// $mpdf->WriteHTML('');
// $mpdf->Image($imgpath,0,0,$width,$height,'png','',true, true);
// $mpdf->Output('../QRCodes/test.pdf', \Mpdf\Output\Destination::FILE);

// -----

// $qr = new QRCode($options);
// $qr = new QRCode(new QROptionsExtended([
//     'svgLogo' => __DIR__.'/../t.svg',
//     'svgConnectPaths'     => true,
//     'eccLevel'            => QRCODE::ECC_H,
//     'imageBase64'         => true,
//     'outputType'          => QRCode::OUTPUT_CUSTOM,
//     'outputInterface'     => QRMarkupExtended::class,
//     // 'clearLogoSpace'      => true,
//     'addLogoSpace' => true,
//     'circleRadius' => .5,
//     'markupDark'          => '',
//     'markupLight'         => '',
//     // 'logoSpaceWidth' => 50,
//     // 'logoSpaceHeight' => 50,
//     // 'logoSpaceStartX' => 50,
//     // 'logoSpaceStartY' => 50,
//     // 'pngCompression' => 9,
//     'scale' => 3,
//     'svgLogoScale'        => 25 / 100,
//     'svgLogoCssClass'     => 'logo',
//     // https://developer.mozilla.org/en-US/docs/Web/SVG/Element/linearGradient
//     'svgDefs'             => '
// <style><![CDATA[
//     .dark{fill: #000000;}
//     .light{fill: #eaeaea;}
//     .logo{fill: #000000;}
// ]]></style>'
// ]));

// echo '<img src="'.$qr->render($data).'" alt="QR Code" />';