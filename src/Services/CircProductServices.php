<?php


namespace App\Services;


use App\Entity\CircProductConfiguration;

class CircProductServices
{
    static function createCircProduct($product): CircProductConfiguration
    {
        $conf = new CircProductConfiguration();
        $conf->setDiameter($product["Diametre"]);
        return $conf;
    }
}