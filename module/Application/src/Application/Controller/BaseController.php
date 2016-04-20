<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class BaseController extends AbstractActionController
{
	protected $_entityManager;
	
	public function onDispatch(\Zend\Mvc\MvcEvent $e) {
//		$this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
		return parent::onDispatch($e);
	}
	
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->_entityManager = $entityManager;
    }
	
	public function getEntityManager()
    {
        return $this->_entityManager;
    }
}
