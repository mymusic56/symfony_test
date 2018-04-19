<?php
namespace AppBundle\EventSubscriber;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use AppBundle\Controller\SignatureCheckController;
use AppBundle\Service\Signatrue;

/**
 * 签名验证
 * @author zhangshengji
 */
class SignatureSubscriber implements EventSubscriberInterface
{
    private $privatekey;
    
    public function __construct($privatekey)
    {
        $this->privatekey = $privatekey;
    }
    
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        
        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }
        
        if ($controller[0] instanceof SignatureCheckController) {
            $signature = new Signatrue();
            $para_temp = array_merge($_GET, $_POST);
            if (empty($para_temp['sign'])) {
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode(['status'=>-1, 'msg' => '缺少签名参数', 'result' => null], JSON_UNESCAPED_UNICODE));
            }
            //过滤参数
            $filteredParam = $signature->paraFilter($para_temp);
            //排序
            $filteredParam = $signature->argSort($filteredParam);
            //构造预处理字符串
            $prestr = $signature->createLinkstring($filteredParam);
            //验证签名
            if (!$signature->md5Verify($prestr, $para_temp['sign'], $this->privatekey)) {
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode(['status'=>-1, 'msg' => '签名验证错误['.$prestr.$this->privatekey.']', 'result' => null], JSON_UNESCAPED_UNICODE));
                exit(json_encode(['status'=>-1, 'msg' => '签名验证错误', 'result' => null], JSON_UNESCAPED_UNICODE));
            }
        }
    }
    
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
        );
    }
}