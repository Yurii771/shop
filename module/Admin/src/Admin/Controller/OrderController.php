<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class OrderController extends AbstractActionController
{
    public function indexAction()
    {
        $entityManager =$this->getServiceLocator()->get('Doctrine\ORM\EntityManager') ;
        //$query=$entityManager->createQuery('SELECT u FROM Admin\Entity\Orders u ORDER BY u.id DESC');
        $query=$entityManager->createQuery('SELECT u,a.orderStatus FROM Admin\Entity\Orders u JOIN Admin\Entity\OrderStatus a WHERE u.orderStatus=a.id   ORDER BY u.id DESC');
        $rows=$query->getResult();
        //var_dump($rows); die();
        return array('orders'=> $rows);
        
    }
    
        public function editAction()
    {
        return new ViewModel();
    }
    

    
}
