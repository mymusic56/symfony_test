<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="groupid", columns={"group_id"})})
 * @ORM\Entity
 */
class Users
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pwd", type="string", length=255, nullable=true)
     */
    private $pwd;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="gender", type="boolean", nullable=true)
     */
    private $gender;

    /**
     * @var string|null
     *
     * @ORM\Column(name="device_mark", type="string", length=50, nullable=true)
     */
    private $deviceMark = '';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true, options={"default"="1"})
     */
    private $enabled = '1';

    /**
     * @var \AppBundle\Entity\Groups
     *
     * @ORM\ManyToOne(targetEntity="Groups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     */
    private $group;



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
     * Set name.
     *
     * @param string|null $name
     *
     * @return Users
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set pwd.
     *
     * @param string|null $pwd
     *
     * @return Users
     */
    public function setPwd($pwd = null)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get pwd.
     *
     * @return string|null
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set gender.
     *
     * @param bool|null $gender
     *
     * @return Users
     */
    public function setGender($gender = null)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender.
     *
     * @return bool|null
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set deviceMark.
     *
     * @param string|null $deviceMark
     *
     * @return Users
     */
    public function setDeviceMark($deviceMark = null)
    {
        $this->deviceMark = $deviceMark;

        return $this;
    }

    /**
     * Get deviceMark.
     *
     * @return string|null
     */
    public function getDeviceMark()
    {
        return $this->deviceMark;
    }

    /**
     * Set created.
     *
     * @param \DateTime|null $created
     *
     * @return Users
     */
    public function setCreated($created = null)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created.
     *
     * @return \DateTime|null
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set enabled.
     *
     * @param bool|null $enabled
     *
     * @return Users
     */
    public function setEnabled($enabled = null)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled.
     *
     * @return bool|null
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set group.
     *
     * @param \AppBundle\Entity\Groups|null $group
     *
     * @return Users
     */
    public function setGroup(\AppBundle\Entity\Groups $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group.
     *
     * @return \AppBundle\Entity\Groups|null
     */
    public function getGroup()
    {
        return $this->group;
    }
}
