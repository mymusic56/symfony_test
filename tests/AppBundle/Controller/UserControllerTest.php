<?php
namespace Test\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



/**
 * @IgnoreAnnotation({"datetime", "author"})
 * @author zhangshengji
 * @datetime 2018年4月4日 下午1:59:32
 */
class UserControllerTest extends WebTestCase{
    /**
     * functional test
     */
    public function testCheck()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/check', [
            'id' => 2
        ]);
        $str = $client->getResponse()->getContent();
        $jsonData = json_decode($str, true);
        $this->assertEquals(1, $jsonData['status']);
    }
}