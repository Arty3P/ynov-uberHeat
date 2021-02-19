<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Services\ProductServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;

class ImportCsvController extends AbstractController
{
    /**
     * @Route("/import/csv", name="import_csv")
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function index(Request $request, ValidatorInterface $validator, ProductRepository $productRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $products = $request->files->get('products');
        if ($products) {
            $extensionFile = ProductServices::checkExtensionFile($products);
            if ($extensionFile === "csv") {
                $records = ProductServices::generateCsvFile($products);
                foreach ($records as $record) {
                    if (ProductServices::checkColumnsNumber(count($record))) {
                        $product = ProductServices::createProduct($record);
                        $entityManager->persist($product);
                        $entityManager->flush();
                        $productInBdd = $productRepository->findBy(["name" => $product->getName()]);
                        if (!$productInBdd) {
                            $entityManager->persist($product);
                            $entityManager->flush();
                        } else {
                            dump("NON");
                        }
                    } else {
                        dump("Nombre de colonnes incorrect :(");
                    }
                }
            } else {
                dump("Merci d'envoyer un fichier au format csv, et non : " . $extensionFile);
            }
        }
        else {
            dump("Format de fichier incorrect :(");
        }

        return $this->render('import_csv/index.html.twig', [
            'controller_name' => 'ImportCsvController',
        ]);
    }
}
