<?php
namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProductBundle\Entity\eMealOrder;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProductBundle:Default:index.html.twig');
    }
    
    public function orderAddAction(Request $request)
    {
        
        $session = $request->getSession();
        
        if($session->has('basket') && $session->has('id')) {

            $em = $this->getDoctrine()->getManager();
            $order = new eMealOrder();
            
            // Add the owner.
            $id_owner = $session->get('id').get(0);
            $owner = $em->getRepository('UserBundle:User')->findById($id_owner);
            $order->setOwner($owner->get(0));
            
            
            $basket = $session->get('basket');        
            $productList = $em->getRepository('ProductBundle:Product')->findById(array_keys($basket));
            
            dump($productList);
            
            return $this->render('ProductBundle:Default:menu.html.twig',
                array('listProducts' => $productList
                    ));
            
            $order->setProductsList($productsList);
                
            /*
            $em->persist($order);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'The order has been saved correctly.');*/
            
        }
        //
        return $this->redirectToRoute('emeal_order');
    }
    
    public function myOrderAction(Request $request)
    {
        
        $session = $request->getSession();
        
        if($session->has('id')) {
        
            $em = $this->getDoctrine()->getManager();
            $user_repository = $em->getRepository('UserBundle:User');
            $order_repository = $em->getRepository('ProductBundle:eMealOrder');
        
            $idOwner = $session->get('id');
            $owner = $user_repository->find($idOwner);
        
            $listOrder = $order_repository->findByOwner($owner);
             
            return $this->render('ProductBundle:Default:order.html.twig',
                    array('listOrder' => $listOrder
                        ));
        } else {
            return $this->render('ProductBundle:Default:order.html.twig',
                    array('listOrder' => null
                        ));
        }
    }
    
    public function allOrderAction()
    {
        $product_repository = $this
                      ->getDoctrine()
                      ->getManager()
                      ->getRepository('ProductBundle:eMealOrder');

        $listOrder= $product_repository->findAll();
             
        return $this->render('ProductBundle:Default:order.html.twig',
                array('listOrder' => $listOrder
                    ));
    }
          
}
