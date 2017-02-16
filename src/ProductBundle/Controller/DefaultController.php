<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProductBundle:Default:index.html.twig');
    }
    
    public function menuAction()
    {
        
        
        
        
        
        return $this->render('ProductBundle:Default:menu.html.twig');
    }
    
    public function basketAction()
    {
        return $this->render('ProductBundle:Default:basket.html.twig');
    }
}
