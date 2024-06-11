<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{

    private $em;

    /* ce constructeur est une bonne pratique.  */
    public function __construct(EntityManagerInterface $em) /* $this->getContainer->get('ORM' donctrine manager) c'est une autre manière de récuperer l'em avec les service */
    {
        $this->em = $em;
    }

    #[Route('/products', name: 'app_products')]
    public function index(Request $request, PaginatorInterface $paginator, ProductRepository $repository ): Response
    {

        /* $product = new Product(); */
        $product = $this->em->getRepository(Product::class)->findAll();

        $product = $paginator->paginate(
            $product, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );

        return $this->render('product/product.html.twig',  compact('product')    
        );
    }

    #[Route('/products/details/{id}', name: 'product_details', requirements: ['id' => '\d+'])]
    public function details($id)/* : Response */
    {
        $product = $this->em->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Le produit n\'existe pas');
        }

        return $this->render("product/product_details.html.twig", [
            'product' => $product,
            /* 'candidature' => new Candidature(), // Créez une nouvelle instance de Candidature */
        ]);
    }
}
