<?php
require __DIR__.'/../vendor/chillerlan/php-qrcode/examples/QRImageWithText.php';

class QRImageWithText extends chillerlan\QRCodeExamples\QRImageWithText{
    /**
	 * @param string $text
	 */
	protected function addText(string $text):void{
		// save the qrcode image
		$qrcode = $this->image;

		// options things
		$textSize  = 3; // see imagefontheight() and imagefontwidth()
		$textBG    = [200, 200, 200];
		$textColor = [50, 50, 50];

		$bgWidth  = $this->length;
		$bgHeight = $bgWidth + 10; // 20px extra space

		// create a new image with additional space
		$this->image = imagecreatetruecolor($bgWidth, $bgHeight);
		$background  = imagecolorallocate($this->image, ...$textBG);

		// allow transparency
		if($this->options->imageTransparent && in_array($this->options->outputType, $this::TRANSPARENCY_TYPES, true)){
			imagecolortransparent($this->image, $background);
		}

		// fill the background
		imagefilledrectangle($this->image, 0, 0, $bgWidth, $bgHeight, $background);

		// copy over the qrcode
		imagecopymerge($this->image, $qrcode, 0, 0, 0, 0, $this->length, $this->length, 100);
		imagedestroy($qrcode);

		$fontColor = imagecolorallocate($this->image, ...$textColor);
		$w         = imagefontwidth($textSize);
		$x         = round(($bgWidth - strlen($text) * $w) / 2);

		// loop through the string and draw the letters
		foreach(str_split($text) as $i => $chr){
			imagechar($this->image, $textSize, (int)($i * $w + $x), $this->length - 14, $chr, $fontColor);
		}
	}
}