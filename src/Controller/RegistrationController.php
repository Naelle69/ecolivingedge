<?php

namespace App\Controller;

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Security\Authenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // Redirection après l'inscription réussie
            return $this->redirectToRoute('user_profil'); // Remplacez 'dashboard' par le nom de la route vers laquelle vous souhaitez rediriger

            // Si vous préférez rediriger après connexion, vous pouvez utiliser:
            // return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/index.html.twig', [
            'registration' => $form->createView(),
        ]);
    }
}
