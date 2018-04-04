<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 *
 * @ORM\Table(name="group")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupRepository")
 */
class Group
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true, options={"default"="1"})
     */
    private $enabled = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return the $enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param Ambigous <string, NULL> $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param Ambigous <number, boolean, NULL> $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }




    
}
