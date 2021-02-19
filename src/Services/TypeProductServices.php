<?php


namespace App\Services;


use App\Entity\CircProductConfiguration;
use App\Entity\RectProductConfiguration;

class TypeProductServices
{
    static function determineType($product)
    {
        if($product["Type"] === "Rectangulaire") {
            return TypeProductServices::createRectProduct($product);
        } else if($product["Type"] === "Circulaire") {
            return TypeProductServices::createCircProduct($product);
        }
    }

    static function createRectProduct($product): RectProductConfiguration
    {
        $conf = new RectProductConfiguration();
        $conf->setHeight($product["Hauteur"]);
        $conf->setWidth($product["Largeur"]);
        $conf->setThickness($product["Epaisseur"]);
        return $conf;
    }

    static function createCircProduct($product): CircProductConfiguration
    {
        $conf = new CircProductConfiguration();
        $conf->setDiameter($product["Diametre"]);
        return $conf;
    }
}