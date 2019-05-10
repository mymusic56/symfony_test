<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcher;
use AppBundle\Entity\Order;
use AppBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Orders;
use AppBundle\Entity\OrderCombos;

/**
 * @Route("/orders")
 * @author zhangshengji
 * 2018年7月31日 上午11:22:21
 */
class OrdersController extends Controller{
    
    /**
     * 查询order表，默认关联了order_combos, combos, users表，如何设置关联层级
     * @Route("/orderList")
     */
    public function orderList()
    {
        $orderData = $this->getDoctrine()->getManager()->getRepository(Orders::class)->findAll();
        
        /* @var $order \AppBundle\Entity\Orders */
        /* @var $orderCombo \AppBundle\Entity\OrderCombos */
        
        foreach ($orderData as $order) {
            
            foreach ($order->getOrderCombo() as $orderCombo) {
                $res = 'orderId:'.$order->getId();
                $res .= ',userId:'.$order->getUser()->getId();
                $res .= ',order_combos.id:'.$orderCombo->getId();
                $res .= ',comboName:'.$orderCombo->getComboName();
                $res .= ',combos.id:'.$orderCombo->getCombo()->getId();
                var_dump($res);
            }
        }
        
        die('success');
    }
    
    
    /**
     * 查询order_combos表，默认关联了orders, combos, users表，如何设置关联层级
     * @Route("/orderComboList")
     */
    public function orderComboList()
    {
        $orderComboData = $this->getDoctrine()->getManager()->getRepository(OrderCombos::class)->findAll();
        
        /* @var $orderCombo \AppBundle\Entity\OrderCombos */
        foreach ($orderComboData as $orderCombo) {
            $res = 'userId:'.$orderCombo->getOrder()->getUser()->getId();
            $res .= 'orderId:'.$orderCombo->getOrder()->getId();
            $res .= 'order_combos.id:'.$orderCombo->getId();
            $res .= 'order_combos.combo_name:'.$orderCombo->getComboName();
            $res .= 'comboId:'.$orderCombo->getCombo()->getId();
            var_dump($res);
        }
        
        die('success');
    }
}