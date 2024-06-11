<?php

namespace App\Service;

use App\Entity\Product;
use App\Entity\CartItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
 
    public $entityManager;
public $session;
    public function __construct(sessionInterface $session,EntityManagerInterface $entityManager)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    public function addToCart(Product $product)
    {
        $cart = $this->session->get('cart');
        
        $productId = $product->getId();
        
        if (!isset($cart[$productId])) {
            $cart[$productId] = [
                'product' => $product,
                'quantity' => 0,
                ];
        }

        $cart[$productId]['quantity']++;

        $this->session->set('cart', $cart);
    }

    public function getCartItem(): array
    {
        $cart = $this->session->get('cart');

        $cartItems = [];

        foreach ($cart as $item) {
            $cartItem = new CartItem();
            $cartItem->setProduct($item['product']);
            $cartItem->setQuantity($item['quantity']);
            $cartItems[] = $cartItem;
        }

        return $cartItems;
    }

    public function removeFromCart(int $productId)
    {
        $cart = $this->session->get('cart');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->session->set('cart', $cart);
        }
    }
}
