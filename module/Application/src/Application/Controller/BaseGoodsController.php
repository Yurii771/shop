<?php

namespace Application\Controller;

class BaseGoodsController extends BaseController
{
	
	public function onDispatch(\Zend\Mvc\MvcEvent $e) {
		
		return parent::onDispatch($e);
	}

}