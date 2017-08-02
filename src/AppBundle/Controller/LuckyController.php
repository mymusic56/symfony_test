<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class LuckyController
{
    /**
     * @Route("/lucky/number")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);
        
        return new Response(
                '<html><body>Lucky number: '.$number.'</body></html>'
                );
    }
    
    /**
     * @Route("/lucky/newAdd")
     */
    public function newAddAction(){
        $number = mt_rand(100, 900);
        
        return new Response(
                '<html><body>Lucky number: '.$number.'</body></html>'
                );
    }
    
    /**
     * @Route("/lucky/edit")
     */
    public function editAction(){
        $number = mt_rand(1000, 9000);
        
        return new Response(
                '<html><body>Lucky number: '.$number.'</body></html>'
                );
    }
}