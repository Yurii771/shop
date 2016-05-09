<?php

namespace Guest\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use \Zend\View\Model\ViewModel;
use Zend\Db\Adapter\AdapterInterface;
use Application\Controller\BaseController;
use Admin\Entity\Goods;
use Admin\Entity\Categories;
use Doctrine\ORM\EntityManager;



class GoodsController extends BaseController
{    
    public function __construct($em) {
        $this->_entityManager = $em;
    }
    
    public function indexAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $query=$this->_entityManager->createQuery("SELECT g FROM Admin\Entity\Goods g WHERE g.category=$id");
        $rows=$query->getResult();
        return array('goods'=>$rows);
        
    }
    
    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $goods = $this->_entityManager->find('\Admin\Entity\Goods', $id);
        return new ViewModel(array('goods' => $goods));
    }
            
}