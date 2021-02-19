<?php


namespace App\Services;


use App\Entity\RectProductConfiguration;

class RectProductServices
{
    static function createRectProduct($product): RectProductConfiguration
    {
        $conf = new RectProductConfiguration();
        $conf->setHeight($product["Hauteur"]);
        $conf->setWidth($product["Largeur"]);
        $conf->setThickness($product["Epaisseur"]);
        return $conf;
    }
}