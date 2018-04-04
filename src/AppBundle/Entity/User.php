<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
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
     * @var int|null
     *
     * @ORM\Column(name="group_id", type="integer", nullable=true)
     */
    private $groupId;

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
     * @return the $pwd
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @return the $gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return the $groupId
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @return the $deviceMark
     */
    public function getDeviceMark()
    {
        return $this->deviceMark;
    }

    /**
     * @return the $created
     */
    public function getCreated()
    {
        return $this->created;
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
     * @param Ambigous <string, NULL> $pwd
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }

    /**
     * @param Ambigous <boolean, NULL> $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @param Ambigous <number, NULL> $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * @param Ambigous <string, NULL> $deviceMark
     */
    public function setDeviceMark($deviceMark)
    {
        $this->deviceMark = $deviceMark;
    }

    /**
     * @param Ambigous <DateTime, NULL> $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @param Ambigous <boolean, NULL> $enabled
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
