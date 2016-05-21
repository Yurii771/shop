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
<<<<<<< HEAD
    public function indexAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $query=$this->getEntityManager()->createQuery("SELECT g FROM Admin\Entity\Goods g WHERE g.category=$id");
=======
    public function __construct($em) {
        $this->_entityManager = $em;
    }
    
    public function indexAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $query=$this->_entityManager->createQuery("SELECT g FROM Admin\Entity\Goods g WHERE g.category=$id");
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
        $rows=$query->getResult();
        return array('goods'=>$rows);
        
    }
    
    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
<<<<<<< HEAD
        $goods = $this->getEntityManager()->find('\Admin\Entity\Goods', $id);
=======
        $goods = $this->_entityManager->find('\Admin\Entity\Goods', $id);
>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
        return new ViewModel(array('goods' => $goods));
    }
            
}