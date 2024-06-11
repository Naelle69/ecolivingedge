<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
        #[Route('/category/add', name: 'add_category')]
        public function add(EntityManagerInterface $manager, Request $request): Response
        {
            $category = new Category();
            
            $form = $this->createForm(CategoryType::class, $category);
            $form->handleRequest($request);
            
            if($form->isSubmitted() and $form->isvalid())
            {/* dd($form->getData()) */;
                $manager->persist($form->getData());
                $manager->flush();
                $this->redirectToRoute('list_category');
            }
    
            return $this->render('category/addCategory.html.twig', [
                'form'=>$form->createView()
            ]);
        }
    
       #[Route('/category/list', name: 'list_category')]
        public function list(EntityManagerInterface $manager){
            return new Response('les categories'); 
                $categories= $manager->getRepository(Category::class)->findAll();
                return $this->render("categories/list.html.twig",
                ['categories'=>$categories]);
        }
    
 }   
