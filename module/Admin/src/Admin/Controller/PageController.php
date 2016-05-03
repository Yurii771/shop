<?php

namespace Admin\Controller;

use Application\Controller\BaseAdminController as BaseController;
use Zend\Validator\Regex;
use Zend\View\Model\ViewModel;
use Admin\Entity\Categories;
use Admin\Entity\Cllg;

class PageController extends BaseController
{
    public function __construct($em) {
        $this->_entityManager = $em;
    }
    public function indexAction() {
        //$query=$this->getEntityManager()->createQuery('SELECT u FROM Admin\Entity\Goods u where u.id=1');
        //$good_data=$query->getResult();
        //var_dump($good_data);
        $query = $this->getEntityManager()->createQuery('SELECT u FROM Admin\Entity\Categories u');
        $rows = $query->getResult();
        $query=$this->getEntityManager()->createQuery('select p.name from Admin\Entity\Cllg u left join Admin\Entity\Categories p where p.id=u.categories_id order by u.id');
        $result=$query->getResult();
        return array('categories' => $rows, 'categoriesId' => $result);
    }
    public function saveAction(){
        for($i=1; $i<=9; $i++){
            echo $i;
            $query=$this->getEntityManager()->createQuery('SELECT u.id FROM Admin\Entity\Categories u where u.name='."'".$_POST['categorie'.$i]."'");
            $result=$query->getResult();
            var_dump($result[0]['id']);
            $query=$this->getEntityManager()->createQuery('UPDATE Admin\Entity\Cllg u SET u.categories_id='.$result[0]['id'].' WHERE u.id='.$i);
            $result=$query->getResult();
            var_dump($result);
        }
        return $this->redirect()->toRoute('admin', array('controller' => 'page', 'action' => 'index'));;
    }
}