<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface; // Importer le EntityManagerInterface
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $entityManager; // Déclarer la variable pour stocker l'EntityManager

    // Injecter l'EntityManager dans le constructeur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
   
    #[Route('/cart', name: 'app_cart')]
    public function viewCart(CartService $cartService): Response
    {
        $cartItems = $cartService->getCartItem();

        return $this->render('cart/cart.html.twig', [
            'cartItems' => $cartItems,
        ]);
    }

    #[Route('/add-to-cart/{productId}', name: 'add_to_cart')]
    public function addToCart(int $productId, CartService $cartService): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->find($productId); // Utiliser l'EntityManager pour obtenir le produit

        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        $cartService->addToCart($product);

        return $this->redirectToRoute('app_cart');
    }
    
    #[Route('/cart/remove-from-cart/{productId}', name: 'remove_from_cart')]
    public function removeFromCart(int $productId, CartService $cartService): Response // Ajouter un paramètre pour recevoir l'id du produit à supprimer
    {
        $cartService->removeFromCart($productId); // Utiliser l'id du produit pour supprimer l'élément du panier

        return $this->redirectToRoute('app_cart');
    }
}


/*namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

 class CardController extends AbstractController
{
    #[Route('/card', name: 'app_card')]
    public function index(): Response
    {
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }
}
 */