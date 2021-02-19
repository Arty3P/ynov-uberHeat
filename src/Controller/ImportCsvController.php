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
        $fileType = $products->getClientMimeType();
        if($products && $fileType === "text/csv") {
            $records = ProductServices::generateCsvFile($products);
            foreach ($records as $record) {
                if(ProductServices::checkColumnsNumber(count($record))) {
                    $product = ProductServices::createProduct($record);
                    $entityManager->persist($product);
                    $entityManager->flush();
                    /*$productInBdd = $productRepository->findBy(["name" => $product->getName()]);*/
                    /*if(!$productInBdd) {
                        dump("OK");
                        $entityManager->persist($product);
                        $entityManager->flush();
                    } else {
                        dump("NON");
                    }*/
                }
                else {
                    dump("Nombre de colonnes incorrect :(");
                }
            }
        } else if(!$products) {
            dump("Merci d'envoyer un fichier ^^");
        } else {
            dump("Format de fichier incorrect :(");
            dump("Format envoyé : " . $fileType);
        }

        return $this->render('import_csv/index.html.twig', [
            'controller_name' => 'ImportCsvController',
        ]);
    }
}
