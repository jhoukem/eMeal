<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProductBundle\Entity\eMealOrder;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller {

    public function indexAction() {
        return $this->render('ProductBundle:Default:index.html.twig');
    }
    

    public function orderAddAction(Request $request) {
        $securityContext = $this->container->get('security.authorization_checker');

        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

            $session = $request->getSession();

            if ($session->has('basket')) {

                $em = $this->getDoctrine()->getManager();
                $order = new eMealOrder();

                // Add the owner.
                $order->setOwner($this->getUser());


                $basket = $session->get('basket');
                $productList = $em->getRepository('ProductBundle:Product')->findById(array_keys($basket));

                dump($productList);

                if ($productList != null) {
                    $order->setProductsList($productList);

                    $em->persist($order);
                    $em->flush();
                    $request->getSession()->getFlashBag()->add('notice', 'The order has been saved correctly.');
                    $session->remove('basket');
                }
            }
        }
        //
        return $this->redirectToRoute('emeal_order');
    }

    public function myOrderAction() {

        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

            $em = $this->getDoctrine()->getManager();
            $order_repository = $em->getRepository('ProductBundle:eMealOrder');

            $listOrder = $order_repository->findByOwner($this->getUser());
        }

        return $this->render('ProductBundle:Default:order.html.twig', array('listOrder' => $listOrder
        ));
    }

    public function allOrderAction() {

        $order_repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('ProductBundle:eMealOrder');
        $listOrder = null;
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('ROLE_ADMIN')) {
            $listOrder = $order_repository->findAll();
            return $this->render('ProductBundle:Default:order.html.twig', array('listOrder' => $listOrder
        ));
        } else {
           return $this->redirectToRoute('not_found');     
        }
        
    }
          
}
