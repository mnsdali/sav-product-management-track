<?php
namespace App\Http\Dto;

class ReverseGeocoding {
    protected string $address;

    public function __construct($lat, $lng, $api_key = "be7d63967724f1b82f547d6e619bf163") {
        $url = "https://geokeo.com/geocode/v1/reverse.php?lat=".$lat. "&lng=".$lng. "&api="."$api_key";

        // Call API
        $json = file_get_contents($url);
        $response = json_decode($json, true); // Decode JSON as an associative array

        if (array_key_exists('status', $response)) {
            if ($response['status'] == 'ok') {
                $this->address = $response['results'][0]['formatted_address'];
            } else {
                $this->address = "UNKNOWN ADDRESS";
            }
        } else {
            $this->address = "UNKNOWN ADDRESS";
        }
    }

    public function getAddress(): string {
        return $this->address;
    }
}



