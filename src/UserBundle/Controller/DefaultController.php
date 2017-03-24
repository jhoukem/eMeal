<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
	/* public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository('UserBundle:User')->findAll();
        
        return $this->render('UserBundle::layout.html.twig', array('utilisateurs' => $utilisateurs));
    }*/
    public function utilisateurAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		$utilisateur = $em->getRepository('UserBundle:User')->find($id);

		return $this->render('UserBundle:Default:login.html.twig'); 
		
	}
    
}
