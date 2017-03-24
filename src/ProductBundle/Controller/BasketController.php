<?php

namespace ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BasketController extends Controller
{


 public function addToBasketAction($id, Request $request)
    {
        $session = $request->getSession();
        
        if (!$session->has('basket')) {
            $session->set('basket', array());
        }
        $basket = $session->get('basket');
        if (!array_key_exists($id, $basket)) {
            $basket[$id] = 0;
        }
        $basket[$id] = $basket[$id] + 1;
        $session->set('basket', $basket);   
             
         return $this->redirectToRoute('product_basket');      
    }
    
    public function basketAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $session = $request->getSession();
        if (!$session->has('basket')) {
            $session->set('basket', array());
        }
        
        $basket =  $session->get('basket');
        $product_repository = $em->getRepository('ProductBundle:Product');   
        
        $productList = $product_repository->getProductListWithCategory(array_keys($basket));
        
        return $this->render('ProductBundle:Default:basket.html.twig',
                array('productList' => $productList,
                      'quantity' => $basket,
                    ));
    }

}