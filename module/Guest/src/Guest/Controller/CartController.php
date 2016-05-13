<?php

namespace Guest\Controller;

use Application\Controller\BaseAdminController as BaseController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CartController extends BaseController
{
    public function __construct($em) {
        $this->_entityManager = $em;
    }
    
    public function indexAction()
    {
        $cart = NULL;
        if(isset($_SESSION['orders'])){
            $cart = $_SESSION['orders'];
        }
        return new ViewModel(array('cart' => $cart));
    }
    
    public function addAction()
    {
        $respond = array(
            'ok' => 0,
            'msg' => array(),
        );
        if(!isset($_SESSION['orders'])){
            $_SESSION['orders']=array();
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        if($this->getRequest()->isPost() && $id){
            $count = (int) $this->getRequest()->getPost('count');
            $count = ($count)? $count: 1;
            $index = $this->getIndexByGoodsId($_SESSION['orders'], $id);
            
            if($index === FALSE){
                $goods = $this->getEntityManager()->find('Admin\Entity\Goods', $id);
                $_SESSION['orders'][] = array(
                    'goods' => $goods,
                    'count' => $count,
                );
            }else{
                $_SESSION['orders'][$index]['count'] += $count;
            }
            $respond['ok'] = 1;
        }
        return new JsonModel($respond);
    }
    
    public function editAction()
    {
        $respond = array(
            'ok' => 0,
            'msg' => array(),
        );
        $id = (int) $this->params()->fromRoute('id', 0);
        if(isset($_SESSION['orders']) && $this->getRequest()->isPost() && $id){
            $cart = $_SESSION['orders'];
            $count = (int) $this->getRequest()->getPost('count');
            $index = $this->getIndexByGoodsId($cart, $id);
            if($index !== FALSE){
                $cart[$index]['count'] = $count;
                $_SESSION['orders'] = $cart;
                $respond['ok'] = 1;
            }
        }
        return new JsonModel($respond);
    }
    
    public function deleteAction()
    {
        $respond = array(
            'ok' => 0,
            'msg' => array(),
        );
        $id = (int) $this->params()->fromRoute('id', 0);
        if(isset($_SESSION['orders']) && $id){
            $cart = $_SESSION['orders'];
            $index = $this->getIndexByGoodsId($cart, $id);
            if($index !== FALSE){
                unset($cart[$index]);
                $_SESSION['orders'] = $cart;
                $respond['ok'] = 1;
            }
        }
        return new JsonModel($respond);
    }
        
    public function countAction() {
        $count = 0;
        if(isset($_SESSION['orders'])){
            $count = count($_SESSION['orders']);
        }
        echo $count;
        die();
    }
    
    protected function getIndexByGoodsId($cart, $goods_id) {
        for($i=0; $i<count($cart); $i++){
            if($cart[$i]['goods']->getId() === $goods_id){
                return $i;
            }
        }
        return FALSE;
    }
}