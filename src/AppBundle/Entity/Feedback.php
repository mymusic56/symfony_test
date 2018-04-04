<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FeedbackRepository")
 */
class Feedback
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="device_mark", type="string", length=50, nullable=true)
     * @Assert\NotBlank(
     *      message = "参数错误[device_mark]"
     * )
     */
    private $deviceMark = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=true)
     * @Assert\NotBlank(
     *      message = "参数错误[content]"
     * )
     * 
     */
    private $content = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="system", type="string", length=15, nullable=true)
     * @Assert\NotBlank(
     *      message = "参数错误[system]"
     * )
     */
    private $system = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip", type="string", length=126, nullable=true)
     */
    private $ip = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="created", type="integer", nullable=true)
     */
    private $created = '0';

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
     * @return the $deviceMark
     */
    public function getDeviceMark()
    {
        return $this->deviceMark;
    }

    /**
     * @return the $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return the $system
     */
    public function getSystem()
    {
        return $this->system;
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
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Ambigous <string, NULL> $deviceMark
     */
    public function setDeviceMark($deviceMark)
    {
        $this->deviceMark = $deviceMark;
    }

    /**
     * @param Ambigous <string, NULL> $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param Ambigous <string, NULL> $system
     */
    public function setSystem($system)
    {
        $this->system = $system;
    }

    /**
     * @param Ambigous <number, NULL> $created
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
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return the $ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param Ambigous <string, NULL> $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }



    
    

}
