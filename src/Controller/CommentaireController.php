<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Product;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CommentaireController extends AbstractController
{
    #[Route('/commentaire/add/{id}', name: 'app_commentaire')]
    public function addComment(ValidatorInterface $validator ,Request $request, EntityManagerInterface $manager, $id): Response
    {
        
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

           $product=  $manager->getRepository(Product::class)->find($id);
           $commentaire->setProduct($product);

            $donnees = $form->getData();
            $manager->persist($commentaire);
            $manager->flush();
            return $this->redirectToRoute('product_details', ['id' => $commentaire->getProduct()->getId()]);
        }

        return $this->render('commentaire/addCommentaire.html.twig', [
            'id' => $id,
            'form' => $form->createView()
        ]);
    }
}
