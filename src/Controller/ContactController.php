<?php

namespace App\Controller;

use App\AntiSpam;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Mail\SenderMail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $manager, AntiSpam $antiSpam, SenderMail $senderMail): Response
    {
                //on a au départ une Contact vide
        $contact = new Contact();

        /* crée moi un formulaire ContactType qui sera lié à l'entité Contact */
        $form = $this->createForm(ContactType::class, $contact);

        /* handleRequest permet d'hydrater les infos récupèrées avec le formulaire */
        $form->handleRequest($request);

        if($antiSpam->alert($form->get('subject')->getData())){
            throw new Exception('Le message est considéré comme un spam');
        }

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request); 
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();
            return $this->redirectToRoute('app_contact');

            $senderMail->sendEmail('Jean','Nana', 'Nono');
        }
 
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
