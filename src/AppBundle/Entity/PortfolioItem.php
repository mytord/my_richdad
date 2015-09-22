<?php

namespace AppBundle\Entity;

use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Symbol;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PortfolioItem
 *
 * @ORM\Table()
 * @UniqueEntity(
 *     fields={"symbol", "user"},
 *     errorPath="symbol",
 *     message="Your portfolio already have same symbols."
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PortfolioItemRepository")
 */
class PortfolioItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="symbolId", type="integer")
     */
    private $symbolId;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;


    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="portfolioItems")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     **/
    private $user;

    /**
     * @var Symbol
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Symbol", fetch="EAGER")
     * @ORM\JoinColumn(name="symbolId", referencedColumnName="id")
     **/
    private $symbol;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getSymbolId()
    {
        return $this->symbolId;
    }

    /**
     * @param int $symbolId
     */
    public function setSymbolId($symbolId)
    {
        $this->symbolId = $symbolId;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return PortfolioItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param mixed $symbol
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

}

