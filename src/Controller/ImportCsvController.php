<?php

namespace App\Controller;

use App\Entity\CircProductConfiguration;
use App\Entity\Product;
use App\Entity\RectProductConfiguration;
use Doctrine\ORM\EntityManager;
use League\Csv\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;

use League\Csv\Reader;
use League\Csv\Statement;

class ImportCsvController extends AbstractController
{
    /**
     * @Route("/import/csv", name="import_csv")
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return Response
     * @throws Exception
     */
    public function index(Request $request, ValidatorInterface $validator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $products = $request->files->get('products');
        set_time_limit(10000);

        if ($products) {
            $csv = Reader::createFromPath($products, 'r');
            $csv->setHeaderOffset(0);
            $csv->setDelimiter(';');
            $stmt = Statement::create()
                ->offset(0)
                ->limit(50)
            ;

            $records = $stmt->process($csv);
            foreach ($records as $record) {
                $product = new Product();
                $product->setName($record["Article"]);

                $db1 = ImportCsvController::replaceCommaWithDot($record["1m"]);
                $db2 = ImportCsvController::replaceCommaWithDot($record["2m"]);
                $db5 = ImportCsvController::replaceCommaWithDot($record["5m"]);
                $db10 = ImportCsvController::replaceCommaWithDot($record["10m"]);

                $conf = "";
                if ($record["Type"] === "Rectangulaire") {
                    $conf = new RectProductConfiguration();
                    $conf->setHeight($record["Hauteur"]);
                    $conf->setWidth($record["Largeur"]);
                    $conf->setThickness($record["Epaisseur"]);
                } else if ($record["Type"] === "Circulaire") {
                    $conf = new CircProductConfiguration();
                    $conf->setDiameter($record["Diametre"]);
                }

                $conf->setDB1($db1);
                $conf->setDB2($db2);
                $conf->setDB5($db5);
                $conf->setDB10($db10);
                $conf->setDepth($record["Profondeur"]);
                $product->addConfiguration($conf);

                $errors = $validator->validate($product);
                if (count($errors) > 0) {
                    return new Response((string) $errors, 400);
                }

                $entityManager->persist($product);
                $entityManager->flush();
            }
        }

        return $this->render('import_csv/index.html.twig', [
            'controller_name' => 'ImportCsvController',
        ]);
    }

    public function replaceCommaWithDot(String $field)
    {
        return str_replace(',', '.', $field);
    }
}
