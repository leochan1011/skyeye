<?php
namespace App\Classes;

class LonLatCalculator{
    var $longitude;
    var $latitude;
    function computerThatLonLat($lon, $lat, $brng, $dist){
        $a = 6378137;
        $b = 6356752.3142;
        $f = 1 / 298.2572236;
        $alpha1 = deg2rad ($brng);
        $sinAlpha1 = sin($alpha1);
        $cosAlpha1 = cos($alpha1);
        $tanU1 = (1 - $f) * tan(deg2rad($lat));
        $cosU1 = 1 / sqrt((1 + $tanU1 * $tanU1));
        $sinU1 = $tanU1 * $cosU1;
        $sigma1 = atan2($tanU1, $cosAlpha1);
        $sinAlpha = $cosU1 * $sinAlpha1;
        $cosSqAlpha = 1 - $sinAlpha * $sinAlpha;
        $uSq = $cosSqAlpha * ($a * $a - $b * $b) / ($b * $b);
        $A = 1 + $uSq / 16384 * (4096 + $uSq * (-768 + $uSq * (320 - 175 * $uSq)));
        $B = $uSq / 1024 * (256 + $uSq * (-128 + $uSq * (74 - 47 * $uSq)));
        $cos2SigmaM=0;
        $sinSigma=0;
        $cosSigma=0;
        $sigma = $dist / ($B * $A);
        $sigmaP = 2 * PI();
        while (abs($sigma - $sigmaP) > 1e-12) {
            $cos2SigmaM = cos(2 * $sigma1 + $sigma);
            $sinSigma = sin($sigma);
            $cosSigma = cos($sigma);
            $deltaSigma = $B * $sinSigma * ($cos2SigmaM + $B / 4 * ($cosSigma * (-1 + 2 * $cos2SigmaM * $cos2SigmaM) - $B / 6 * $cos2SigmaM * (-3 + 4 * $sinSigma * $sinSigma) * (-3 + 4 * $cos2SigmaM * $cos2SigmaM)));
            $sigmaP = $sigma;
            $sigma = $dist / ($b * $A) + $deltaSigma;
        }
        $tmp = $sinU1 * $sinSigma - $cosU1 * $cosSigma * $cosAlpha1;
        $lat2 = atan2($sinU1 * $cosSigma + $cosU1 * $sinSigma * $cosAlpha1, (1 - $f) * sqrt($sinAlpha * $sinAlpha + $tmp * $tmp));
        $lambda = atan2($sinSigma * $sinAlpha1, $cosU1 * $cosSigma - $sinU1 * $sinSigma * $cosAlpha1);
        $C = $f / 16 * $cosSqAlpha * (4 + $f * (4 - 3 * $cosSqAlpha));
        $L = $lambda - (1 - $C) * $f * $sinAlpha * ($sigma + $C * $sinSigma * ($cos2SigmaM + $C * $cosSigma * (-1 + 2 * $cos2SigmaM * $cos2SigmaM)));

        $revAz = atan2($sinAlpha, -$tmp);
        $this->longitude= $lon+rad2deg($L);
        $this->latitude= rad2deg($lat2);

    }

    public function getLongitude(){
        return $this->longitude;
    }

    public function getLatitude(){
        return $this->latitude;
    }

}