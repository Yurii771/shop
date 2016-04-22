<?php

namespace Application\Controller;

<<<<<<< HEAD
class BaseGuestController extends BaseController
=======
class BaseAdminController extends BaseController
>>>>>>> refs/remotes/origin/master
{
	
	public function onDispatch(\Zend\Mvc\MvcEvent $e) {
		
		return parent::onDispatch($e);
	}

}