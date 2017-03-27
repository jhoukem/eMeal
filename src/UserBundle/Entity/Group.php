<?php
// src/UserBundle/Entity/Group.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
//use vendor\friendsofsymfony\user-bundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;

}