<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="feedback")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FeedbackRepository")
 */
class Feedback{
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(name="device_mark", type="string", length=50)
     * @Assert\NotBlank(
     *      message = "参数错误[device_mark]"
     * )
     */
    private $deviceMark;
    
    /**
     * @ORM\Column(name="system", type="string", length=15)
     * @Assert\Choice(
     *      choices = {"ios", "android"},
     *      message = "参数错误[system]"
     * )
     */
    private $system;
    
    /**
     * @ORM\Column(name="content", type="string", length=255)
     * @Assert\NotBlank(
     *      message = "参数错误[content]"
     * )
     */
    private $content;
    
    /**
     * @ORM\Column(name="created", type="integer")
     */
    private $created;
    
    /**
     * @ORM\Column(name="enabled", type="integer")
     * 
     */
    private $enabled;
    
    /**
     * 
     * @var string
     * @ORM\Column(name="ip", type="string", length=126)
     * @Assert\Ip
     */
    private $ip;
    
    /**
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }


    
    
    /**
     * @return string $deviceMark
     */
    public function getDeviceMark()
    {
        return $this->deviceMark;
    }

    /**
     * @param string $deviceMark
     */
    public function setDeviceMark($deviceMark)
    {
        $this->deviceMark = $deviceMark;
    }

    /**
     * @return string $system
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return int $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @param string $system
     */
    public function setSystem($system)
    {
        $this->system = $system;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param number $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }
    /**
     * @return int $enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param int $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
    /**
     * @return string $ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

}

