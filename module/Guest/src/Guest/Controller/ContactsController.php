<?php
namespace Guest\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
class ContactsController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}