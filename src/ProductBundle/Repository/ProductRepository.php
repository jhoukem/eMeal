<?php

namespace ProductBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    
    
    
    
    
    
    
    // Using this function to get the basket because we want to load the categories for each product.
    public function getProductList($product_id)
    {
           
         $qb = $this->createQueryBuilder('p')
                    ->where('p.id = :product_id')
                    ->leftJoin('p.category', 'cate')
                    ->addSelect('cate')
                    ;
         
        return $qb->getQuery()->getResult();
        
    }
    
}
