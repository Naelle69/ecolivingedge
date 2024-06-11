<?php

namespace App\Controller;

use App\Repository\PrestationRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatalogueController extends AbstractController
{
    #[Route('/catalogue', name: 'app_catalogue')]
    public function index(): Response
    {  
        return $this->render('catalogue/index.html.twig');
    }


    #[Route('/product', name: 'app_product')]
    public function product(ProductRepository $productRepository): Response
    {
        
        return $this->render('catalogue/product.html.twig', [
            "products" => $productRepository->findAll(), 
        ]);
    }


    #[Route('/prestation', name: 'app_prestation')]
    public function prestation(PrestationRepository $prestationRepository): Response
    {
        
        return $this->render('catalogue/prestation.html.twig', [
            "prestations" => $prestationRepository->findAll(), 
        ]);
    }
}

/* 
    public function index(ProductRepository $productRepository, 
                        PrestationRepository $prestationRepository, 
                        Request $request, 
                        EntityManagerInterface $manager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request); 
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this->render('home/index.html.twig', [
            "products" => $productRepository->findAll(), 
            "prestations" => $prestationRepository->findAll(),
            'form' => $form->createView()
        ]);
    } */
