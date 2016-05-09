<?php

namespace Admin\Controller;

use Application\Controller\BaseAdminController as BaseController;
use Zend\Validator\Regex;
use Zend\View\Model\ViewModel;
use Admin\Entity\Categories;
use Admin\Entity\Cllg;
use Admin\Entity\Slider;

class PageController extends BaseController
{
    public function __construct($em) {
        $this->_entityManager = $em;
    }
    public function indexAction() {
        $query = $this->getEntityManager()->createQuery('SELECT u FROM Admin\Entity\Categories u');
        $rows = $query->getResult();
        $query = $this->getEntityManager()->createQuery('SELECT u FROM Admin\Entity\Slider u');
        $slider = $query->getResult();
        $query=$this->getEntityManager()->createQuery('select p.name from Admin\Entity\Cllg u left join Admin\Entity\Categories p where p.id=u.categories_id order by u.id');
        $result=$query->getResult();
        return array('categories' => $rows, 'categoriesId' => $result, 'sliderImg'=>$slider);
    }
    public function saveAction(){
        for($i=1; $i<=9; $i++){
            $query=$this->getEntityManager()->createQuery('SELECT u.id FROM Admin\Entity\Categories u where u.name='."'".$_POST['categorie'.$i]."'");
            $result=$query->getResult();
            $query=$this->getEntityManager()->createQuery('UPDATE Admin\Entity\Cllg u SET u.categories_id='.$result[0]['id'].' WHERE u.id='.$i);
            $result=$query->getResult();
        }
        return $this->redirect()->toRoute('admin', array('controller' => 'page', 'action' => 'index'));;
    }
    public function savesliderAction(){
        var_dump($_FILES);
        for($i=1; $i<=3; $i++){
            $upload = move_uploaded_file($_FILES['image' . $i]['tmp_name'], 'C:/wamp/www/shop/public/img/' . $_FILES['image' . $i]['name']);
            $file_info = $_FILES['image' . $i];
            if(!empty($file_info['name'])){
                $query=$this->getEntityManager()->createQuery('UPDATE Admin\Entity\Slider u SET u.img_way=\''.$file_info['name'].'\' WHERE u.id='.$i);
                $result=$query->getResult();
            }
        }
        return $this->redirect()->toRoute('admin', array('controller' => 'page', 'action' => 'index'));;
    }
}