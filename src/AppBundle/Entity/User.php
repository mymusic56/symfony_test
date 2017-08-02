<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @author zhangshengji
 *
 */
class User{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    
    
    /**
     * @ORM\Column(type="string")
     */
    protected $pwd;
    
    /**
     * @ORM\Column(type="integer") 
     */
    protected $gender;
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function setPwd($pwd){
        $this->pwd = $pwd;
    }
    
    public function getId(){
        return $this->id;
    }
    public function setGender($gender){
        $this->gender = $gender;
    }
    
    public function getName(){
        return $this->name;
    }
    public function getPwd(){
        return $this->pwd;
    }
    
    public function getGender(){
        return $this->gender;
    }
}