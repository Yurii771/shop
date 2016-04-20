<?php

namespace Guest\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use \Zend\View\Model\ViewModel;
use Zend\Db\Adapter\AdapterInterface;
use Application\Controller\BaseGoodsController as BaseController;
use Admin\Entity\Goods;
use Admin\Entity\Categories;
use Doctrine\ORM\EntityManager;

//use Guest\Forms\ShowCategoryForm;
//use Guest\Model\Guest;

class GoodsController extends BaseController
{    
    public function indexAction()
    {
        $query=$this->getEntityManager()->createQuery('SELECT g FROM Admin\Entity\Goods g WHERE g.category=7');
        $rows=$query->getResult();
        return array('goods'=>$rows);
        
    }
    
    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $goods = $this->getObjectManager()->find('\Admin\Entity\Goods', $id);
        return new ViewModel(array('goods' => $goods));
    }
        
    
    
    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
    
}