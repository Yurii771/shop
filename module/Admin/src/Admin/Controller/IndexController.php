<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    protected $_objectManager;

    public function __construct($em) {
        $this->_objectManager = $em;
    }

    public function indexAction() {
        $entityManager = $this->_objectManager;
        $order_status_query = $entityManager->createQuery("SELECT u.orderStatus,COUNT(a.id) FROM Admin\Entity\OrderStatus u LEFT JOIN Admin\Entity\Orders a  WHERE a.orderStatus= u.id GROUP BY u.orderStatus");
        $order_status = $order_status_query->getResult();

        return array('order_status' => $order_status);
    }

    function showOrders() {
        
    }

}
