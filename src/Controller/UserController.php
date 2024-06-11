<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profil', name: 'user_profil')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'utilisateur authentifié
        $user = $this->getUser();
        
        // Vérifier si l'utilisateur est connecté et a déjà acheté le produit
        $authenticated = isset($user) && !empty($user);
        $buyed = false; // À modifier avec votre logique de vérification d'achat

        // Créer le formulaire avec les données de l'utilisateur
        $form = $this->createForm(UserType::class, $user);
        
        // Soumission du formulaire
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // Persistez et sauvegardez les changements dans la base de données
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Profil mis à jour avec succès');
                
                return $this->redirectToRoute('user_profil');
            }
        }

        return $this->render('user/user.html.twig', [
            'form' => $form->createView(),
            'authenticated' => $authenticated,
            'buyed' => $buyed,
        ]);
    }
}
