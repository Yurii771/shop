<?php

namespace Guest\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
	public function paymentAction()
    {
        return new ViewModel();
    }
    public function aboutAction()
    {
        return new ViewModel();
    }
    public function contactsAction()
    {
        return new ViewModel();
    }
}
