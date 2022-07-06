<?php

namespace App\Http\Controllers;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Font\Font;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public final function setFlash(string $message, bool $status = false): void
    {
        session()->flash('message', $message);
        session()->flash('status', $status);
    }

    protected function getDataUser()
    {

    }

    private function _qrCode(string $code): QrCode
    {
        return QrCode::create($code)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(500)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
    }

    private function _qrLogo(): Logo
    {
        return Logo::create(public_path('assets/images/logo-prov.png'))
            ->setResizeToWidth(120)
            ->setResizeToHeight(150);
    }

    private function _qrLabel(string $label): Label
    {
        $font = public_path('/assets/fonts/noto_sans.otf');
        return Label::create($label)->setText($label)
            ->setFont(new Font($font, 30))
            ->setTextColor(new Color(0, 0, 0));
    }

    public final function generateQrCode(string $code, string $filename, string $label = ''): string
    {
        try {
            $writer = new PngWriter();
            $qrCode = $this->_qrCode($code);
            $logo = $this->_qrLogo();
            $result = $label ? $writer->write($qrCode, $logo, $this->_qrLabel($label)) : $writer->write($qrCode, $logo);
            header('Content-Type: ' . $result->getMimeType());
            $result->saveToFile($filename);
            return $result->getDataUri();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public final function printQrCode(string $qr_code, string $label = '')
    {
        try {
            $writer = new PngWriter();
            $qrCode = $this->_qrCode($qr_code);
            $logo = $this->_qrLogo();
            $result = $label ? $writer->write($qrCode, $logo, $this->_qrLabel($label)) : $writer->write($qrCode, $logo);
            header('Content-Type: ' . $result->getMimeType());
            return $result->getDataUri();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
