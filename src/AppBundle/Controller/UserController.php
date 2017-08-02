<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User;
use AppBundle\Serverice\UserService;

class UserController extends Controller{
    /**
     * @Route("/user/userList")
     */
    public function userList(){
        /*
         * ORM框架使用　　Doctrine
         * http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/query-builder.html
         */
        
        /*
         * 用法一：
         * find all
         * $list is a object, should add get method in User.php Entity to get the value
         */
//         $list1 = $this->getDoctrine()->getRepository(User::class)->findAll();
//         var_dump($list1);

        /*
         * 用法二：
         * find by conditions
         */
        $criteria = array(
                'gender' => 1
        );
        $order = array('id' => 'DESC');
        
        $limit = 2;
        
        $offset = 2;
//         $list = $this->getDoctrine()->getRepository(User::class)->findBy($criteria,$order,$limit,$offset);
        
        
        /*
         * 用法三：
         */
        // createQueryBuilder() automatically selects FROM AppBundle:User
        // and aliases it to "p"
        /* $query = $this->getDoctrine()->getRepository(User::class)->createQueryBuilder('u')
        ->where('u.id > :id')
        ->setParameter('id',3)
        ->orderBy('u.id', 'ASC')
        ->setFirstResult( $offset )
        ->setMaxResults( $limit )
        ->getQuery();
        
        $list = $query->getResult(); */
        
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                'SELECT u
                    FROM AppBundle:User u
                    WHERE u.id > :id
                    ORDER BY u.id ASC'
                )->setParameter('id', 3);
                
        $list = $query->getResult();
        var_dump( $list);
        return $this->render('user/userList.html.twig',array(
                'userList' => $list,
                'title' => '用户列表'
        ));
    }
    
    /**
     * @Route("/user/userInfo")
     */
    public function useInfo(){
        return new Response('user info');
    }
    /**
     * @Route("/check/{id}/{gender}",defaults={"id"=2,"gender":1}, requirements={
     *      "id":"\d+"
     * })
     * @Method("GET")
     */
    public function check($id,$gender){
        /*
         * 访问地址： http://symfony.mytest.com/check/1
         * placeholder use case
         * defaults : 默认不传入id值为2. 可以使用= 或者 :类似json的对象
         * requirements : use regular expressions to verify the input data 【注意必须使用双引号】
         *              验证失败： No route found for "GET /check/4r"
         *              _locale : support different langage
         *              
         * @Method("GET") : indecate that the request is limited to use get method
         * 
         * 如何支持： http://symfony.mytest.com/check?id=2&gender=2
         * 
         */
        return new Response("获取用户 :$id 的信息， 并且性别为：$gender");
    }
    
    /**
     * @Route("/check2/{id}", name="show_user")
     */
    public function check2($id){
        /*
         * http://symfony.mytest.com/check2/1
         * name的作用：
         */
        return new Response("check2, 获取用户 :$id 的信息");
    }
    
    /**
     * @Route("/user/saveUserInfo")
     */
    public function saveUserAction(){
        $em = $this->getDoctrine()->getManager();
        
        $user = new User();
        $user->setName('wangwu');
        $user->setPwd('abcdefg');
        $user->setGender(2);
        
        $em->persist($user);
        
        $em->flush();
        
        return new Response('Saved new product with id '.$user->getId());
    }
    
    /**
     * @Route("/user/getRandom")
     */
    public function getRandom(UserService $userService){
        $res = $userService::aaa();
        $b = $userService->b();
        return new Response("random: $res, $b");
    }
    
    /**
     * @Route("/user/getRandom2")
     */
    public function getRandom2(){
        /*
         * 没有语法提示
         */
        $userService = $this->get(UserService::class);
        $res = $userService::aaa();
        $b = $userService->b();
        return new Response("getRandom2: $res, $b");
    }
    
    
}