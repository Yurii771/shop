<?php

namespace Guest\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Goods\Form\GoodsForm;
use Zend\Db\Adapter\AdapterInterface;
use Guest\Entity\Goods;
use Doctrine\ORM\EntityManager;

class IndexController extends AbstractActionController
{
  protected $_objectManager;
    public function indexAction()
    {
        return new ViewModel();
    }

    public function searchAction()
    {
    $searchItem=  $this->params()->fromPost('search');   // From POST
    $query = $this->getObjectManager()->createQuery("SELECT u FROM Guest\Entity\Goods u WHERE u.name LIKE '%$searchItem%' ");
    $rows = $query->getResult();
    $categories = $this->getObjectManager()->getRepository('\Guest\Entity\Categories')->findAll();
      return new ViewModel(array('goods' => $rows,'searchItem'=>$searchItem, 'categories'=>$categories));

    }


    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}
