<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, Security $security): Response
    {
        if ($this->getUser()) {
            // Si l'utilisateur est déjà connecté, redirige-le vers une route spécifique
            return $this->redirectToRoute('homepage');
        }
    
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
    
        // Récupère l'utilisateur connecté
        $user = $security->getUser();
    
        if ($user) {
            // Récupère le rôle de l'utilisateur
            $role = $user->getRoles()[0]; // Supposons que tu veuilles récupérer le premier rôle de l'utilisateur
            // Redirige en fonction du rôle de l'utilisateur
            if ($role === 'ROLE_ADMIN') {
                return $this->redirectToRoute('admin_dashboard');
            } elseif ($role === 'ROLE_USER') {
                return $this->redirectToRoute('user_profile');
            }
        }
    
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
