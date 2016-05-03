<?php

namespace Guest\Controller;

use Application\Controller\BaseAdminController as BaseController;

class IndexController extends BaseController
{
	public function __construct($em) {
        $this->_entityManager = $em;
    }
	
    public function indexAction()
    {
        $query = $this->getEntityManager()->createQuery('select p.name from Admin\Entity\Cllg u left join Admin\Entity\Categories p where p.id=u.categories_id');
        $result = $query->getResult();
        return array('categoriesId' => $result);
    }
}
