<?php

namespace ProductBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{    
    
    // Using this function to get the basket because we want to load the categories for each product.
    public function getProductListWithCategory($products_id)
    {
        $qb = $this->createQueryBuilder('p')
                    ->where('p.id IN(:products_id)')
                    ->leftJoin('p.category', 'cate')
                    ->addSelect('cate')
                    ;
        $qb->setParameter('products_id', $products_id);
        return $qb->getQuery()->getResult();
        
    }
    
    public function getProductListComplete()
    {
        $qb = $this->createQueryBuilder('p')
                    ->leftJoin('p.category', 'cate')
                    ->leftJoin('p.ingredients', 'ingre')
                    ->addSelect('cate')
                    ->addSelect('ingre')
                    ;
        return $qb->getQuery()->getResult();
        
    }
    
}
