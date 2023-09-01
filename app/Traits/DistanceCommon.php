<?php

namespace App\Traits;
use App\Models\Article;
use App\Models\Technicien;
use Illuminate\Http\Client\Request;

trait DistanceCommon {

    public function getCoordsFromIpAddr($ip, $access_key='67dc70e022a715f175f3bbec89ce52df'){
            $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $json = curl_exec($ch);
            curl_close($ch);

            $api_result = json_decode($json, true);
            $defaultClientLat = $api_result['latitude'];
            $defaultClientLng = $api_result['longitude'];
            return [ $defaultClientLat,$defaultClientLng] ;

        }

        public function splitCoords($coords_str): array
        {
            $pattern = "/[\s,]/";
            $coords_arr = preg_split($pattern, $coords_str);
            return $coords_arr;
        }

        public function calculateDistance($lat1, $lon1, $lat2, $lon2)
        {
            $earthRadius = 6371; // Radius of the Earth in kilometers

            // Convert latitude and longitude from degrees to radians
            $lat1Rad = deg2rad($lat1);
            $lon1Rad = deg2rad($lon1);
            $lat2Rad = deg2rad($lat2);
            $lon2Rad = deg2rad($lon2);

            // Calculate the differences between latitudes and longitudes
            $deltaLat = $lat2Rad - $lat1Rad;
            $deltaLon = $lon2Rad - $lon1Rad;

            // Haversine formula
            $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
                cos($lat1Rad) * cos($lat2Rad) *
                sin($deltaLon / 2) * sin($deltaLon / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            // Calculate the distance
            $distance = $earthRadius * $c;

            return $distance;
        }

        public function findClosestTechnicien($machine_coords): array
        {
            $machine_coords_arr = $this->splitCoords($machine_coords);
            $machine_latitude = floatval($machine_coords_arr[0]);
            $machine_longitude = floatval($machine_coords_arr[1]);
            $techniciens = Technicien::where('isAvailable', 1);
            $bestTech = null;
            $bestDist = -1;

            foreach ($techniciens as $technicien) {
                $technicien_coords = $technicien->google_maps_coordinates;
                $technicien_coords_arr = $this->splitCoords($technicien_coords);
                $technicien_latitude = floatval($technicien_coords_arr[0]);
                $technicien_longitude = floatval($technicien_coords_arr[1]);

                $distance = $this->calculateDistance($machine_latitude, $machine_longitude, $technicien_latitude, $technicien_longitude);

                if ($bestDist == -1 || $bestDist > $distance) {
                    $bestTech = $technicien;
                    $bestDist = $distance;
                }
            }

            return ['bestTech' => $bestTech, 'bestDist' => $bestDist];
        }
        /**
     * sort the resources for editing the specified resource.
     */
    public function sort(Request $request)
    {
        $coords = $request->get('coords');
        $coords_arr = $this->splitCoords($coords);
        $machine_latitude = floatval($coords_arr[0]);
        $machine_longitude = floatval($coords_arr[1]);
        $techniciens = Technicien::where('isAvailable', "1")->get();

        $distPerTech = array();

        foreach ($techniciens as $technicien) {
            $technicien_coords = $technicien->google_maps_coordinates;
            $technicien_coords_arr = $this->splitCoords($technicien_coords);
            $technicien_latitude = floatval($technicien_coords_arr[0]);
            $technicien_longitude = floatval($technicien_coords_arr[1]);

            $distance = $this->calculateDistance($machine_latitude, $machine_longitude, $technicien_latitude, $technicien_longitude);
            $distPerTech[$technicien->email] = $distance;
        }

        asort($distPerTech);
        $result = array();
        $index = 0;
        foreach ($distPerTech as $techEmail => $val) {
            $tech = Technicien::join('users', 'techniciens.email', '=', 'users.email')
                ->where('email',  $techEmail)->get(['techniciens.*', 'users.num_tel1', 'users.num_tel2']); // Fetch the technicien data using the ID
            $result[$index] = array(
                'email' => $tech->email,
                'username' => $tech->username,
                'num_tel1' => $tech->num_tel1,
                'num_tel2' => $tech->num_tel2,
                'distance' => $val
            );
            $index++;
        }

        return response()->json(
            $result
            );
    }

}
