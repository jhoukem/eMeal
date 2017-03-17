<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use ProductBundle\Form\ProductType;
use ProductBundle\Form\CategoryType;
use ProductBundle\Form\IngredientType;
use ProductBundle\Entity\Product;
use ProductBundle\Entity\Category;
use ProductBundle\Entity\Ingredient;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('ProductBundle:Default:index.html.twig');
    }
    
    public function menuAction(Request $request)
    {               
        $product_repository = $this
                      ->getDoctrine()
                      ->getManager()
                      ->getRepository('ProductBundle:Product');

        $listProducts = $product_repository->getProductListComplete();
             
        return $this->render('ProductBundle:Default:menu.html.twig',
                array('listProducts' => $listProducts
                ));
    }
    
    public function menuNavBarAction(Request $request)
    {          
        $product_repository = $this
                      ->getDoctrine()
                      ->getManager()
                      ->getRepository('ProductBundle:Product');

        $listProducts = $product_repository->getProductListComplete();
             
        return $this->render('ProductBundle:Default:listProducts.html.twig',
                array('listProducts' => $listProducts
                ));
    }
      
    public function addProductAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        
        if ($request->isMethod('POST')) {

            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $product contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
            // On enregistre notre objet $advert dans la base de données, par exemple

                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'The product has been saved correctly.');
            } else {
                $request->getSession()->getFlashBag()->add('notice', 'Error the product has not been saved.');
            }
            return $this->redirectToRoute('product_menu');      
        }
        
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('ProductBundle:Default:addProduct.html.twig', array(
      'form' => $form->createView()));
    }
    
    
    public function addCategoryAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        
        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'The category has been saved correctly.');
            } else {
                $request->getSession()->getFlashBag()->add('notice', 'Error the category has not been saved.');
            }
            return $this->redirectToRoute('product_menu');      
        }
        
        return $this->render('ProductBundle:Default:addCategory.html.twig', array(
      'form' => $form->createView()));
    }
    
    public function addIngredientAction(Request $request)
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        
        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ingredient);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'The ingredient has been saved correctly.');
            } else {
                $request->getSession()->getFlashBag()->add('notice', 'Error the ingredient has not been saved.');
            }
            return $this->redirectToRoute('product_menu');      
        }
        
        return $this->render('ProductBundle:Default:addIngredient.html.twig', array(
      'form' => $form->createView()));
    }
    
}
