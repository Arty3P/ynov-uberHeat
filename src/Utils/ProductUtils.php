<?php


namespace App\Utils;


class ProductUtils
{
    static function replaceCommaWithDot(String $field)
    {
        return str_replace(',', '.', $field);
    }
}