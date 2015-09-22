<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\PortfolioItem;

/**
 * @ORM\Entity
 * @ORM\Table(name="acme_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var PortfolioItem[]
     *
     * @OneToMany(targetEntity="PortfolioItem", mappedBy="user")
     **/
    private $portfolioItems;

    public function __construct() {
        BaseUser::__construct();

        $this->portfolioItems = new ArrayCollection();
    }

    /**
     * @return \AppBundle\Entity\PortfolioItem[]
     */
    public function getPortfolioItems()
    {
        return $this->portfolioItems;
    }

    /**
     * @param \AppBundle\Entity\PortfolioItem[] $portfolioItems
     */
    public function setPortfolioItems($portfolioItems)
    {
        $this->portfolioItems = $portfolioItems;
    }

}