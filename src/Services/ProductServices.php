<?php


namespace App\Services;

use App\Entity\Product;

use App\Utils\ProductUtils;

use League\Csv\Reader;
use League\Csv\Statement;

class ProductServices
{
    static function checkExtensionFile($file)
    {
        $fileName = $file->getClientOriginalName();
        return pathinfo($fileName, PATHINFO_EXTENSION);
    }

    static function generateCsvFile($file): \League\Csv\TabularDataReader
    {
        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(';');
        $stmt = Statement::create()
            ->offset(0)
            ->limit(50)
        ;
        return $stmt->process($csv);
    }

    static function checkColumnsNumber($columns): bool
    {
        if($columns === 11) {
            return true;
        }
        return false;
    }

    static function createProduct($row): Product
    {
        $product = new Product();
        $product->setName($row["Article"]);

        $db1 = ProductUtils::replaceCommaWithDot($row["1m"]);
        $db2 = ProductUtils::replaceCommaWithDot($row["2m"]);
        $db5 = ProductUtils::replaceCommaWithDot($row["5m"]);
        $db10 = ProductUtils::replaceCommaWithDot($row["10m"]);

        $conf = TypeProductServices::determineType($row);
        $conf->setDB1($db1);
        $conf->setDB2($db2);
        $conf->setDB5($db5);
        $conf->setDB10($db10);
        $conf->setDepth($row["Profondeur"]);

        $product->addConfiguration($conf);

        return $product;
    }
}