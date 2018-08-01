<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Orders
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Orders
{

    /**
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @var bool|null
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     *
     * @var int|null
     *
     * @ORM\Column(name="created", type="integer", nullable=true)
     */
    private $created;

    /**
     *
     * @var \AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    
    /**
     * Doctrine 默认只能生成One-to-One 和 Many-to-One
     * 这个需要手动生成
     * @ORM\OneToMany(targetEntity="OrderCombos", mappedBy="order")
     */
    private $orderCombo;

    
    public function __construct(Users $user)
    {
        $this->user = $user;
        $this->orderCombo = new ArrayCollection();
    }
    
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status.
     *
     * @param bool|null $status
     *
     * @return Orders
     */
    public function setStatus($status = null)
    {
        $this->status = $status;
        
        return $this;
    }

    /**
     * Get status.
     *
     * @return bool|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created.
     *
     * @param int|null $created
     *
     * @return Orders
     */
    public function setCreated($created = null)
    {
        $this->created = $created;
        
        return $this;
    }

    /**
     * Get created.
     *
     * @return int|null
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\Users|null $user
     *
     * @return Orders
     */
    public function setUser(\AppBundle\Entity\Users $user = null)
    {
        $this->user = $user;
        
        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\Users|null
     */
    public function getUser()
    {
        return $this->user;
    }
    
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getOrderCombo()
    {
        return $this->orderCombo;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $orderCombo
     */
    public function setOrderCombo($orderCombo)
    {
        $this->orderCombo = $orderCombo;
    }
    
}
