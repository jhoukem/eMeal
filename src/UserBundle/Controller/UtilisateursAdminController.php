<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UtilisateursAdminController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository('UserBundle:User')->findAll();
        
        return $this->render('UserBundle:Administration:User/layout/index.html.twig', array('User' => $utilisateurs));
    }
    
    public function utilisateurAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		$utilisateur = $em->getRepository('UserBundle:User')->find($id);
		$route = $this->container->get('request')->get('_route');
		
		}
}
