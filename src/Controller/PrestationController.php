<?php

namespace App\Controller;

use App\Repository\PrestationRepository;
use App\Repository\PurchaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class PrestationController extends AbstractController
{
    #[Route('/prestation', name: 'app_prestation')]
    public function index(PrestationRepository $prestationRepository, PurchaseRepository $purchaseRepository): Response
    {


        return $this->render('prestation/prestation.html.twig', [
            "prestation" => $prestationRepository->findAll(),
        ]);
    }
}


