<?php

namespace Application\Controller;

class BaseGuestController extends BaseController
{
	
	public function onDispatch(\Zend\Mvc\MvcEvent $e) {
		
		return parent::onDispatch($e);
	}

}