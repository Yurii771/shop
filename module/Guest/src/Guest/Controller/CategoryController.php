<?php

namespace Guest\Controller;

use Application\Controller\BaseAdminController as BaseController;

class CategoryController extends BaseController
{
    public function __construct($em) {
        $this->_entityManager = $em;
    }
    
    public function indexAction()
    {
        $query = $this->_entityManager->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
        $rows = $query->getResult();
        return array('categories' => $rows);
    }
}
