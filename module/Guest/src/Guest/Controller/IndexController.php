<?php

namespace Guest\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $_objectManager;
    
    public function __construct($em) {
        $this->_objectManager = $em;
    }
    
    public function indexAction()
    {
        return new ViewModel();
    }

    public function searchAction()
    {
        $searchItem=  $this->params()->fromPost('search');
        if(empty($searchItem)){
          return $this->redirect()->toRoute('guest');
        }
        $query = $this->_objectManager->createQuery("SELECT u FROM Admin\Entity\Goods u WHERE u.name LIKE '%$searchItem%' ");
        $rows = $query->getResult();
        $categories = $this->_objectManager->getRepository('\Admin\Entity\Categories')->findAll();

      return new ViewModel(array('goods' => $rows,'searchItem'=>$searchItem, 'categories'=>$categories));
    }
    
    public function sitemapAction() {
        return new ViewModel();
    }
}
