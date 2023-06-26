<?php
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\QRCodeException;

class QROptionsExtended extends QROptions{
    // path to svg logo
	protected ?string $svgLogo = null;
	// logo scale in % of QR Code size, clamped to 10%-30%
	protected float $svgLogoScale = 0.20;
	// css class for the logo (defined in $svgDefs)
	protected string $svgLogoCssClass = '';
	// whether to clear the logo space
	protected bool $clearLogoSpace = true;

	// check logo
	protected function set_svgLogo(?string $svgLogo):void{
		if(empty($svgLogo)){
			$this->svgLogo = null;

			return;
		}

		if(!file_exists($svgLogo) || !is_readable($svgLogo)){
			throw new QRCodeException('invalid svg logo');
		}

		// @todo: validate svg
		$this->svgLogo = $svgLogo;
	}

	// clamp logo scale
	protected function set_svgLogoScale(float $svgLogoScale):void{
		$this->svgLogoScale = max(0.05, min(0.3, $svgLogoScale));
	}
}