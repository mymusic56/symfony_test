<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller{
    
    /**
     * @Route("/test/mcache", name="memcacheTest")
     */
    public function memcacheTest()
    {
        $this->get('logger');
        $memcached = $this->get('memcached');
        $res = $memcached->get('test');
        
        if (!$res) {
            $memcached->set('test', microtime(true));
        }
        
        $UserService = $this->get('testservice');
        $b = $UserService->b();
        var_dump($res, $b);
        return new Response('this is a test function.');
    }
}