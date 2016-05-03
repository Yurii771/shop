<?php

namespace Guest\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class CartController extends AbstractActionController
{    
    
    public function countAction() {
        $count = 0;
        if(isset($_SESSION['orders'])){
            $count = count($_SESSION['orders']);
        }
        echo $count;
        die();
    }
    
}