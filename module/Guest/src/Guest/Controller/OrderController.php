<?php

namespace Guest\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class OrderController extends AbstractActionController {

    public function indexAction() {
        return new ViewModel();
    }

    public function confirmAction() {
//        if ($this->request->isPost()) {
//            $data = $this->request->getPost();
//            if (isset($data['name']) && isset($data['surname']) && isset($data['city']) && isset($data['adress']) && isset($data['phone']) && isset($data['email'])) {
//               
//            }
//        }
        return new ViewModel();
    }

}
