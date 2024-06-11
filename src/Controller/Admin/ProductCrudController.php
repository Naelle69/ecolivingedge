<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\Question;
use App\Entity\Reponse;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;

use Symfony\Component\Routing\Annotation\Route;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextEditorField::new('description'),
            MoneyField::new('price')->setCurrency('EUR'),
            AssociationField::new('category'),
            AssociationField::new('prestation'),
            ColorField::new('color')->setLabel('Couleur'),
            TextField::new('city')->setLabel('Ville'),
        ];
    }

    // Action pour afficher et gérer les questions liées au produit
    #[Route('/admin/products/{id}/questions', name: 'product_questions')]
    public function productQuestions(Product $product): Response
    {
        // Afficher et gérer les questions liées au produit $product
        // Vous pouvez implémenter ici la logique pour afficher et gérer les questions liées au produit
        // Par exemple :
        return $this->render('product/product_details.html.twig', [
            'product' => $product,
        ]);
    }

    // Action pour afficher et gérer les réponses liées à une question
    #[Route('/admin/questions/{id}/responses', name: 'question_responses')]
    public function questionReponses(Question $question): Response
    {
        // Afficher et gérer les réponses liées à la question $question
        // Vous pouvez implémenter ici la logique pour afficher et gérer les réponses liées à la question
        // Par exemple :
        return $this->render('product/product_details.html.twig', [
            'question' => $question,
        ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Question', 'fa fa-question', Question::class);
        yield MenuItem::linkToCrud('Reponse', 'fa fa-reply', Reponse::class);
    }

}
