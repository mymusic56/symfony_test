<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Serverice\CurlService;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    
    /**
     * @Route("/hello/{name}", name="hello",defaults={"name"="Guest"})
     * @param String $name
     */
    public function helloAction($name){
        /*
         * 
         */
        //访问地址： http://localhost:8000/hello/zhangsan
        return $this->render('default/hello.html',array(
            'name' => $name    
        ));
    }
    
    /**
     * service
     * 
     * @Route("/testService")
     * 
     */
    public function testServiceAction(){
        $logger = $this->get('logger');
        $res = $logger->info('Look! I just used a service');
        
        return new Response('日志调用结果：'.strval($res));
    }
    /**
     * @Route("/testCurl")
     */
    public function testCurlAction(){
        /*
         * 测试Auto load
         */
        $curl = $this->get(CurlService::class);
        $curl->send('http://finance.yahoo.com/webservice/v1/symbols/allcurrencies/quote', ['format' => 'json']);
        $data = $curl->getResult();
        var_dump($data);die;
    }
}
