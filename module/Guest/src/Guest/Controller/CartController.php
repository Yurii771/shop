<?php

namespace Guest\Controller;

use Application\Controller\BaseAdminController as BaseController;
use Zend\View\Model\ViewModel;
use Zend\Validator\Regex;
use Admin\Entity\Goods;

class CartController extends BaseController
{
    public function __construct($em) {
        $this->_entityManager = $em;
    }
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function addAction()
    {
        if(!isset($_SESSION['orders'])){
            $_SESSION['orders']=array();
        }
        $url=$_SERVER['REQUEST_URI'];
        $url=explode('/', $url);
        $id=$url[count($url)-1];
        $id=1;
        $count=$_POST['count'];
        $query=$this->getEntityManager()->createQuery('SELECT u FROM Admin\Entity\Goods u where u.id='.$id);
        $good_data=$query->getResult();
        $arr['id']=$good_data[0]->getId();
        $arr['name']=$good_data[0]->getName();
        $arr['shortDescription']=$good_data[0]->getShortDescription();
        $arr['count']=$count;
        $arr['max_count']=$good_data[0]->getCount();
        $arr['cost']=$good_data[0]->getCost();
        $arr['photo']=$good_data[0]->getPhoto();
        array_push($_SESSION['orders'], $arr);
        return $this->redirect()->toRoute('guest', array('controller' => 'cart', 'action' => 'index'));
    }
    
    public function editAction()
    {
        $url=$_SERVER['REQUEST_URI'];
        $id=explode('/', $url);
        $id=$id[count($id)-1];
        foreach($_SESSION['orders'] as $key=>$ses){
            if($ses['id']==$id){
                if($_POST['count']<=$_SESSION['orders'][$key]['max_count']){
                    $_SESSION['orders'][$key]['count']=$_POST['count'];
                }
            }
        }
        return $this->redirect()->toRoute('guest', array('controller' => 'cart', 'action' => 'index'));
    }
    
    public function deleteAction()
    {
        $url=$_SERVER['REQUEST_URI'];
        $id=explode('/', $url);
        $id=$id[count($id)-1];
        foreach($_SESSION['orders'] as $key=>$ses){
            if($ses['id']==$id){
                unset($_SESSION['orders'][$key]);
            }
        }
        //session_unset();
        return $this->redirect()->toRoute('guest', array('controller' => 'cart', 'action' => 'index'));
    }
        
    public function countAction() {
        $count = 0;
        if(isset($_SESSION['orders'])){
            $count = count($_SESSION['orders']);
        }
        echo $count;
        die();
    }
}