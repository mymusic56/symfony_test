<?php
namespace AppBundle\Controller\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Feedback;
use AppBundle\Entity\Users;
use AppBundle\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\NativeRequestHandler;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Service\Signatrue;

/**
 * @IgnoreAnnotation({"datetime", "author"})
 * @author zhangshengji
 * @datetime 2018年3月28日 下午3:50:56
 */
class UserController extends Controller{
    
    /**
     * @Route("/user/userList")
     */
    public function userList(){
        
        /* @var $userRepository \AppBundle\Repository\UserRepository */
        $userRepository = $this->getDoctrine()->getRepository(Users::class);
        
        
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
        
        $query = $userRepository->createQueryBuilder('u')
        ->where('u.id > :id')
        ->setParameter('id',3)
        ->orderBy('u.id', 'ASC')
        ->setFirstResult( $offset )
        ->setMaxResults( $limit )
        ->getQuery();
        
        $list = $query->getResult(); 
        
        //em: entity manager
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                'SELECT u
                    FROM AppBundle:Users u
                    WHERE u.id > :id
                    ORDER BY u.id ASC'
                )->setParameter('id', 3);
                
        $list = $query->getResult();
        return $this->render('user/userList.html.twig',array(
                'userList' => $list,
                'title' => '用户列表'
        ));
    }
    
    /**
     * @ApiDoc(
     *      description="老是报字段不存在错误。。。。，原因是定义字段的书写错误"
     * )
     * @Route("/user/error")
     */
    public function occurError()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT u.deviceMark,u.name
                    FROM AppBundle:Users u
                    WHERE u.id > :id
                    ORDER BY u.id ASC'
            )->setParameter('id', 1);
            
        $list = $query->getResult();
        var_dump($list);
        
        $data = $this->getDoctrine()->getRepository(Users::class)->findOneBy([
            'deviceMark' => 'Leeee'
        ]);
        
        var_dump($data);;die;
    }
    
    /**
     * @Route("/user/user_info_from_repository")
     */
    public function userInfoFromRepository()
    {
        
        $em = $this->getDoctrine()->getManager();
        /*
         * 前提条件：\AppBundle\Entity\User注解中加入 @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
         */
        /* @var $userRepository \AppBundle\Repository\UserRepository */
//         $userRepository = $em->getRepository(User::class);
        $userRepository = $em->getRepository('AppBundle:User');
        
        $result = $userRepository->getUserListByGroupId(1);
        
        $res = [];
        /* @var $result \AppBundle\Entity\Users */
        foreach ($result as $item) {
            $res[] = [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'created' => $item->getCreated()->format('Y-m-d H:i:s'),
                'created2' => $item->getCreated()->getTimestamp(),
                'group_id' => $item->getGroupId(),
            ];
        }
        
        var_dump($res);
        return new Response('success');
    }
    
    /**
     * @Route("/user/userInfo")
     */
    public function useInfo(){
        $data = $this->getDoctrine()->getRepository(Users::class)->find(3);
        
        $data2 = $this->getDoctrine()->getManager()->find('AppBundle:Users', 3);
        
        
        var_dump($data, $data2);die;
        return new JsonResponse($data2);
//         return new Response('user info');
    }
    /**
     * ParamConverter
     * 
     * @ApiDoc(
     *      description="默认以参数为主键"
     * )
     * @Route("/user/edit/{id}")
     */
    public function userEdit(Users $user)
    {
        var_dump($user->getId(), $user->getName());die;
    }
    
    /**
     * ParamConverter
     * 
     * @ApiDoc(
     *      description="请求地址： http://symfony.mytest.com/user/edit2/xiaohong"
     * )
     * @Route("/user/edit2/{name}")
     * @ParamConverter("user", class="AppBundle:User", options={"name" = "name"})
     */
    public function userEdit2(Users $user)
    {
        var_dump($user->getId(), $user->getName());die;
    }
    
    /**
     * 总数查询
     * @Route("/user/count")
     */
    public function userCount()
    {
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository(Users::class);
        $result2 = $userRepository->createQueryBuilder('u')
        ->where("u.groupId =:groupId")
        ->select('count(u)')
        ->setParameter("groupId", 1)
        ->getQuery()
        ->getSingleScalarResult();
        var_dump($result2);die;
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
        return new JsonResponse(['status' => 1, 'id'=>$id, 'gender' => $gender]);
//         return new Response("获取用户 :$id 的信息， 并且性别为：$gender");
    }
    
    /**
     * @Route("/check2",defaults={"id"=""},requirements={
     *      "id":"\d+"
     * })
     * @Method("POST")
     */
    public function check2(Request $request){
        $id = $request->request->get('id', '');
        /*
         * http://symfony.mytest.com/check2/1
         * name的作用：
         * 
         * requirements 对 POST请求无效
         */
        return new Response("check2, 获取用户 :$id 的信息");
    }
    
    /**
     * @Route("/user/saveUserInfo")
     */
    public function saveUserAction(){
        //entity manager
        $em = $this->getDoctrine()->getManager();
        
        $user = new Users();
        $user->setName('wangwu');
        $user->setPwd('abcdefg');
        $user->setGender(2);
        
        $em->persist($user);
        
        $em->flush();
        
        return new Response('Saved new product with id '.$user->getId());
    }
    
    /**
     * @ApiDoc(
     *      description="自定义服务，需要在service.yml中配置"
     * )
     * @Route("/user/serviceTest")
     */
    public function serviceTest(){
        /*
         * Service 使用方式一：
         */
        /* @var $userService \AppBundle\Service\UserService */
        $userService = $this->get('userservice');
        $a = $userService::aaa();
        $b = $userService->b();
        return new Response("random: $a, $b");
    }
    
    /**
     * @ApiDoc(
     *      description="测试失败"
     * )
     * @Route("/user/serviceTest2")
     */
    public function serviceTest2(){
        /*
         * Service 使用方式二：
         * 没有语法提示
         * 
         */
        UserService::aaa();
        $userService = $this->get(UserService::class);
        /* @var $userService \AppBundle\Service\UserService */
        $res = $userService::aaa();
        $b = $userService->b();
        return new Response("getRandom2: $res, $b");
    }
    
    /**
     * @ApiDoc(
     *      description="测试失败"
     * )
     * @Route("/user/serviceTest3")
     */
    public function serviceTest3(UserService $userService){
        /*
         * Service 使用方式三：
         */
        $res = $userService::aaa();
        $b = $userService->b();
        return new Response("random: $res, $b");
    }
    
    /**
     * @Route("/user/testRequest")
     */
    public function testRequestAction(Request $request){
        
        /*
         * get session
         */
        $session = $request->getSession();
        $exist = 1;
        $session_name = $session->get('username');
        if(!$session_name){
            $exist = 0;
            $session->set('username', 'zhangsan');
        }
        $return = 'session: '.$exist.',username: '.$session_name.'</br>,';
        
        
        /*
         * get and set cookie
         */
        $cookie_name = $request->cookies->get('cookie_username');
        
        $allCookie = $request->cookies->all();
        $allHeader = $request->headers->all();
        
        $exist = 1;
        $response = new Response();
        #删除cookie
//         $response->headers->clearCookie('cookie_username');
//         $response->send();
        if(!$cookie_name){
            $exist = 0;
            //设置有效时间导致cookie保存失败？？？？
            $response->headers->setCookie(new Cookie('cookie_username', 'zhangsan'));
            $response->send();
//             var_dump($res->headers->getCookies());
        }
        $return .= 'cookie: '.$exist.',username: '.$cookie_name.'</br>,';
        
        
        
        
        $return .= ' request-method:'.$request->getMethod().'</br>,';
        $return .= ' request-host:'.$request->getHost().'</br>,';
        $return .= ' request-uri:'.$request->getUri().'</br>,';
        $return .= ' request-secure:'.$request->isSecure().'</br>,';
        
        /*
         * 获取 request body
         */
        $data = $request->request->all();
        $username = $request->request->get('username');
        
        $return .= json_encode($data);
        $return .= $username;
//         return new Response($return);
        
        return $this->render('user/testRequest.html.twig',array(
                'cookie' => $cookie_name,
                'session' => $session_name,
                'string' => $return
        ));
    }
    
    /**
     * @Route("/user/feedbackUpdate")
     * @Method("post")
     */
    public function updateFeedback(Request $request)
    {
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $feedback = $em->getRepository('AppBundle:Feedback')->findOneBy([
            'id' => $id
        ]);
        
        $user = $em->getRepository('AppBundle:User')->findOneBy([
            'id' => 1
        ]);
        
        if ($feedback) {
            $user->setCreated(date('Y-m-d H:i:s'));
            
            sleep(5);
            $feedback->setContent(date('Y-m-d H:i:s'));
            
            //不用$em->persist($object); 直接刷新保存， 执行两条SQL语句
            $em->flush();
        }
        return new JsonResponse(['status' => 1, 'msg' => 'success']);
    }
    
    /**
     * @ApiDoc(
     *      description="用户提交反馈"
     * )
     * @Method("post")
     * @Route("/user/feedback")
     */
    public function userFeedback(Request $request)
    {
        $device_mark = $request->request->get('device_mark', '');
        $system = $request->request->get('system', '');
        $content = $request->request->get('content', '');
        
        $feedback = new Feedback();
        $feedback->setContent($content);
        $feedback->setSystem($system);
        $feedback->setDeviceMark($device_mark);
        $feedback->setEnabled(1);
        $feedback->setIp($request->getClientIp());
        $feedback->setCreated(time());
        
        $validator = $this->get('validator');
        $errors = $validator->validate($feedback);
        
        if (count($errors) > 0) {
            foreach ($errors as $err) {
                return new JsonResponse(['status'=>-1, 'msg' => $err->getMessage()]);
            }
        }
        
        $em = $this->getDoctrine()->getManager();
        
        $find = $em->getRepository("AppBundle:Feedback")->findOneBy([
            'system' => $system,
            'deviceMark' => $device_mark,
            'enabled' => 1
        ]);
        
        $msg = '已提交';
        if (!$find) {
            $em->persist($feedback);
            $em->flush();
            $msg = '提交成功';
        }
        
        return new JsonResponse(['status'=>1, 'msg' => $msg]);
    }
    
    /**
     * 
     * @Route("/user/signTest")
     */
    public function signTest(Request $request)
    {
        $str = '{"system":"android","appid":"10000","channel":"","version":"1.0.1","timestamp":"15100000000","mobile":"18580151305","type":"1"}';
        $param = json_decode($str, true);
        $signature = new Signatrue();
        $key = 'kkkppp';
        $para_sort = $signature->argSort($param);
        $param['sign'] = $signature->buildRequestMysign($para_sort, $key);
        
        /* @var $curl \AppBundle\Service\CurlService */
        $curl = $this->get('curlservice');
        $url = 'http://symfony.mytest.com/foo/bar';
//         $url = 'http://huilv.qm.com/foo/bar';
        $curl->send($url, $param, 'POST');
        $result = $curl->getResult();
        var_dump($param, $signature->getParamString(), $result);die;
    }
    
    /**
     * @Route("/user/file_cache")
     */
    public function cacheTest()
    {
        
        var_dump(time(), strtotime('+5 min'));
        
        $cache = new \Symfony\Component\Cache\Simple\FilesystemCache();
        $directory = __DIR__.'/../../../var/cache/doccache';
        $docFileCache = new \Doctrine\Common\Cache\FilesystemCache($directory);
        $id = 'doc.file.cache.test';
        $res = $docFileCache->fetch($id);
        if ($res === false) {
            $data = ['test' => 1234];
            $docFileCache->save($id, $data);
            var_dump('id 不存在');
        }
        $docFileCache->deleteAll();
        var_dump($res);
        // save a new item in the cache
        
        // or set it with a custom ttl
        // $cache->set('stats.products_count', 4711, 3600);
        
        // retrieve the cache item
        if (!$cache->has('stats.products_count')) {
            // ... item does not exists in the cache
            $cache->set('stats.products_count', time());
            var_dump('item does not exists in the cache');
        }
        
        // retrieve the value stored by the item
        $productsCount = $cache->get('stats.products_count');
        var_dump($productsCount);
        // or specify a default value, if the key doesn't exist
        // $productsCount = $cache->get('stats.products_count', 100);
        
        // remove the cache key
        $cache->delete('stats.products_count');
        
        // clear *all* cache keys
        $cache->clear();
        exit("eee");
    }
}