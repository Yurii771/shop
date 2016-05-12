<?php

namespace Guest\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\BaseAdminController as BaseController;

class IndexController extends BaseController
{
    protected $_objectManager;
    
    public function __construct($em) {
        $this->_objectManager = $em;
    }
    
    public function indexAction()
    {
        $query = $this->getEntityManager()->createQuery('select p.name from Admin\Entity\Cllg u left join Admin\Entity\Categories p where p.id=u.categories_id');
        $result = $query->getResult();
        $query = $this->getEntityManager()->createQuery('SELECT u FROM Admin\Entity\Slider u');
        $slider = $query->getResult();
//var_dump($result); 
        return array('categoriesId' => $result, 'sliderImg' => $slider);
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