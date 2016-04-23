<?php

namespace Guest\Controller;

use Application\Controller\BaseAdminController as BaseController;
use Zend\Validator\Regex;
use Admin\Entity\Orders;

class OrderController extends BaseController {
    
    public function __construct($em) {
        $this->_entityManager = $em;
    }
    
    public function indexAction() {
        $em = $this->getEntityManager();
        $cities_query = $em->createQuery('SELECT u.id, u.city FROM Admin\Entity\Cities u ');
        $cities = $cities_query->getResult();
        $payment_query = $em->createQuery('SELECT u.id, u.paymentType FROM Admin\Entity\Payment u ');
        $payment = $payment_query->getResult();
        $delivery_query = $em->createQuery('SELECT u.id, u.deliveryType FROM Admin\Entity\Delivery u ');
        $delivery = $delivery_query->getResult();
        return array('cities' => $cities, 'payment' => $payment, 'delivery' => $delivery);
    }

    public function confirmAction() {
        $data = $this->request->getPost();
        if (isset($data['customerName']) && isset($data['customerSurname']) && isset($data['adress']) && isset($data['customerPhone']) && isset($data['customerEmail'])) {
            $validator = new Regex(array('pattern' => '/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'));
            if ($validator->isValid($data['customerPhone'])) {
                $em = $this->getEntityManager();
//                $status = 'Success!';
//                $massage = 'Заказ успешно выполнен';
//                try {
//                if(isset($_SESSION['orders'])){
//                    $goodsInOrder=array(
//                        'id'=>$_SESSION['orders']['id'],
//                        'count'=>$_SESSION['orders']['count']
//                    );
//                    $goodsInOrder=json_encode($goodsInOrder);
//                }
                $order = new Orders; 
                $payment=$em->find('Admin\Entity\Payment',$data['payment']);
                $delivery=$em->find('Admin\Entity\Delivery',$data['delivery']);
                $city=$em->find('Admin\Entity\Cities',$data['city']);  
                $orderStatus=$em->find('Admin\Entity\OrderStatus',1);
                $data['payment']=$payment; 
                $data['delivery']=$delivery;
                $data['city']=$city;
                $data['orderList']='some order';
                $data['orderStatus']=$orderStatus;
//                $order->setOrder($goodsInOrder);        
                $order->exchangeArray($data);
                $em->persist($order);
                $em->flush();
                return $this->redirect()->toRoute('guest', array('controller'=>'order','action'=>'confirm'));
//                } catch (\Exception $ex) {
//                    $status = 'error';
//                    $massage = 'Ошибка при выполнении заказа, проверьте правильность введенных данных';
//                    return $this->redirect()->toRoute('guest', array('controller' => 'Order', 'action' => 'index'));
//                }
            }
        }
    }

}
