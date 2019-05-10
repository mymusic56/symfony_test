<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderCombos
 *
 * @ORM\Table(name="order_combos", indexes={@ORM\Index(name="order_id", columns={"order_id"}), @ORM\Index(name="combo_id", columns={"combo_id"})})
 * @ORM\Entity
 */
class OrderCombos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="combo_name", type="string", length=255, nullable=true)
     */
    private $comboName = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @var \AppBundle\Entity\Combos
     *
     * @ORM\ManyToOne(targetEntity="Combos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="combo_id", referencedColumnName="id")
     * })
     */
    private $combo;

    /**
     * @var \AppBundle\Entity\Orders
     *
     * @ORM\ManyToOne(targetEntity="Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     * })
     */
    private $order;



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
     * Set comboName.
     *
     * @param string|null $comboName
     *
     * @return OrderCombos
     */
    public function setComboName($comboName = null)
    {
        $this->comboName = $comboName;

        return $this;
    }

    /**
     * Get comboName.
     *
     * @return string|null
     */
    public function getComboName()
    {
        return $this->comboName;
    }

    /**
     * Set price.
     *
     * @param string|null $price
     *
     * @return OrderCombos
     */
    public function setPrice($price = null)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return string|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set combo.
     *
     * @param \AppBundle\Entity\Combos|null $combo
     *
     * @return OrderCombos
     */
    public function setCombo(\AppBundle\Entity\Combos $combo = null)
    {
        $this->combo = $combo;

        return $this;
    }

    /**
     * Get combo.
     *
     * @return \AppBundle\Entity\Combos|null
     */
    public function getCombo()
    {
        return $this->combo;
    }

    /**
     * Set order.
     *
     * @param \AppBundle\Entity\Orders|null $order
     *
     * @return OrderCombos
     */
    public function setOrder(\AppBundle\Entity\Orders $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order.
     *
     * @return \AppBundle\Entity\Orders|null
     */
    public function getOrder()
    {
        return $this->order;
    }
}
