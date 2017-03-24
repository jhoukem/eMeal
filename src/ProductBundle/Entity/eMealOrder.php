<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * eMealOrder
 *
 * @ORM\Table(name="e_meal_order")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\eMealOrderRepository")
 */
class eMealOrder {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity="ProductBundle\Entity\Product", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $productsList;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    public function __construct() {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->date = new \Datetime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set owner
     *
     * @param \stdClass $owner
     *
     * @return eMealOrder
     */
    public function setOwner($owner) {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \stdClass
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * Set productsList
     *
     * @param array $productsList
     *
     * @return eMealOrder
     */
    public function setProductsList($productsList) {
        $this->productsList = $productsList;

        return $this;
    }

    /**
     * Get productsList
     *
     * @return array
     */
    public function getProductsList() {
        return $this->productsList;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return eMealOrder
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Get price
     *
     * @return price
     */
    public function getPrice() {
        $price = 0;
        foreach ($this->getProductsList() as $product) {
            $price += $product->getPrice();
        }

        return $price;
    }

    public function toString() {
        $output = $this->getDate()->format("\T\h\\e j/n/Y \a\\t G\h:i") . ": ";

        $output .= "Order n°" . $this->getId(). ": ";

        foreach ($this->getProductsList() as $product) {
            $output .= ($product->getCategory()->getName() ." ". $product->getName() . "(x". $product->quantity."), ");
        }

        $output .= "Total = " . $this->getPrice() . "$";

        return $output;
    }

}
