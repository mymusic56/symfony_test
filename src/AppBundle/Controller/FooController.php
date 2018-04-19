<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/foo")
 * @author zhangshengji
 */
class FooController extends Controller implements SignatureCheckController
{
    // An action that needs authentication
    /**
     * @Route("/bar")
     */
    public function barAction(Request $request)
    {
        return new JsonResponse(['aa'=>1]);
    }
}