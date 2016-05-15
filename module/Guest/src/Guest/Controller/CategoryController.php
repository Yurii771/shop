<?php

namespace Guest\Controller;

use Application\Controller\BaseAdminController as BaseController;

class CategoryController extends BaseController {

    public function __construct($em) {
        $this->_entityManager = $em;
    }

    public function indexAction() {
        $query = $this->getEntityManager()->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
        $rows = $query->getResult();
        $categories = array();
        foreach ($rows as $row) {
            $has_parent = $row->getParent(); 
            if (!$has_parent) {
                $categories[$row->getId()]['parent']=$row;
                $categories[$row->getId()]['children']=array();
            }
        }
        foreach ($rows as $row){
            $has_parent = $row->getParent();
            if ($has_parent) {
                array_push($categories[$row->getParent()->getId()]['children'], $row);
            }
        }

        return array('categories' => $categories);
    }

}
