<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Nette\Utils\DateTime;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleXMLElement;

trait QrCodeCommon {

    public function createDateFolderName(){
        $date = new DateTime(); // Numeric representation of the day of the week (0 = Sunday, 6 = Saturday)

        $currentDate = $date->format('Y_m_d');
        return $currentDate;
    }

    public function saveUrlQrCode($url, $qrName, $nameExtension, $path='public/photos/qr_codes/'){
        $manager = new ImageManager(['driver' => 'imagick']);
        $svg = QrCode::format('svg')->encoding('UTF-8')->size(1000)->margin(5)->generate($url);
        $xml = new SimpleXMLElement($svg);
        $text = $xml->addChild("url_reclamation", 'redirection vers le lien de: '. $nameExtension);
        $text->addAttribute("font-size", "40px");
        $text->addAttribute("x", 50);  // Adjust as needed
        $text->addAttribute("y", 100); // Adjust as needed
        $image = $manager->make($xml->asXML())->encode('png')->stream('png');

        // Save the PNG image to storage
        $fileName = $qrName.'_'.$nameExtension.'.png';
        Storage::put($path . $fileName, $image);
    }

    public function saveTextQrCode($serie_number,$var_designation , $qrName, $nameExtension, $path='public/photos/qr_codes/'){
        $manager = new ImageManager(['driver' => 'imagick']);
        $svg = QrCode::format('svg')->encoding('UTF-8')->size(1000)->margin(5)->generate($serie_number);
        $xml = new SimpleXMLElement($svg);
        $txt = $xml->addChild("text", 'S/N: '.$serie_number. '  [ '.$var_designation.' ]');
        $txt->addAttribute("font-size", "50px");
        $txt->addAttribute("x", 100);
        $txt->addAttribute("y", 950);
        $image = $manager->make($xml->asXML())->encode('png')->stream('png');

        // Save the PNG image to storage
        $fileName = $qrName.'_'.$nameExtension.'.png';
        Storage::put($path . $fileName, $image);
    }
    public function generateQrCodes($serie_number, $var_designation){
        $text = $serie_number;
        $url_reclamation = 'http://127.0.0.1:8000/reclamations/update/'.$serie_number;
        $url_vente = 'http://127.0.0.1:8000/vente/update/'.$serie_number;

        $this->saveTextQrCode($serie_number,$var_designation, $serie_number , 'serie_number');
        $this->saveUrlQrCode($url_reclamation, $serie_number, 'reclamation');
        $this->saveUrlQrCode($url_vente, $serie_number, 'vente');
    }

    public function savePieceQrCode($article_id , $ref_piece, $path='public/photos/qr_codes_pieces/'){
        $manager = new ImageManager(['driver' => 'imagick']);
        $svg = QrCode::format('svg')->encoding('UTF-8')->size(1000)->margin(5)->generate($ref_piece.'#'.$article_id);
        $xml = new SimpleXMLElement($svg);
        $txt = $xml->addChild("text", 'REF: '.$ref_piece.'#'.$article_id);
        $txt->addAttribute("font-size", "50px");
        $txt->addAttribute("x", 100);
        $txt->addAttribute("y", 950);
        $image = $manager->make($xml->asXML())->encode('png')->stream('png');

        // Save the PNG image to storage
        $fileName = $ref_piece.'_'.$article_id.'.png';
        Storage::put($path . $fileName, $image);
    }
}
