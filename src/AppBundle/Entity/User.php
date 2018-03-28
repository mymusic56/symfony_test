<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 *
 */
class User{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
//     /**
//      * @ORM\Column(type="integer")
//      * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
//      * @ORM\JoinColumn(name="group_id",referencedColumnName="id")
//      */
//     private $group;
    
    /**
     * $ORM\Column(name="group_id", type="integer")
     */
    private $groupId;
    
    
    /**
     * @ORM\Column(name="device_mark",type="string")
     */
    private $name;
    
    /**
     * $ORM\Column(name="name", type="string")
     */
    private $device;
    
    /**
     * @ORM\Column(type="string")
     */
    private $pwd;
    
    /**
     * @ORM\Column(type="integer") 
     */
    private $gender;
    
    /**
     * @ORM\Column(type="string")
     */
    private $created;
    
    public function setPwd($pwd){
        $this->pwd = $pwd;
    }
    
    public function getId(){
        return $this->id;
    }
    public function setGender($gender){
        $this->gender = $gender;
    }
    
    public function getPwd(){
        return $this->pwd;
    }
    
    public function getGender(){
        return $this->gender;
    }
    /**
     * @return string $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }
//     /**
//      * @return \AppBundle\Entity\Group $group
//      */
//     public function getGroup()
//     {
//         return $this->group;
//     }

//     /**
//      * @param \AppBundle\Entity\Group $group
//      */
//     public function setGroup(\AppBundle\Entity\Group $group=null)
//     {
//         $this->group = $group;
//     }
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return int $groupId
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }
    /**
     * @return string $device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param string $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    
    
}