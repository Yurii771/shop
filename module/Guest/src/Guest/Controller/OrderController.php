<?php

namespace Guest\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\Regex;
use Admin\Entity\Orders;

class OrderController extends AbstractActionController {
    
    protected $em;

    public function __construct($em) {
        $this->em = $em;
    }
    
    public function indexAction() {
        $cities_query = $this->em->createQuery('SELECT u.id, u.city FROM Admin\Entity\Cities u ');
        $cities = $cities_query->getResult();
        $payment_query = $this->em->createQuery('SELECT u.id, u.paymentType FROM Admin\Entity\Payment u ');
        $payment = $payment_query->getResult();
        $delivery_query = $this->em->createQuery('SELECT u.id, u.deliveryType FROM Admin\Entity\Delivery u ');
        $delivery = $delivery_query->getResult();
        $order_query = $this->em->createQuery('SELECT u FROM Admin\Entity\Orders u ');
        $order = $order_query->getResult();
        
//        var_dump($order[0]->getCity()->getCity()); die();
        
        return array('cities' => $cities, 'payment' => $payment, 'delivery' => $delivery);
    }

    public function confirmAction() {
        $data = $this->request->getPost();
        if (isset($data['customerName']) && isset($data['customerSurname']) && isset($data['adress']) && isset($data['customerPhone']) && isset($data['customerEmail'])) {
            $validator = new Regex(array('pattern' => '/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'));
            if ($validator->isValid($data['customerPhone'])) {
                
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
                    $payment=$this->em->find('Admin\Entity\Payment',$data['payment']);
                    $delivery=$this->em->find('Admin\Entity\Delivery',$data['delivery']);
                    $city=$this->em->find('Admin\Entity\Cities',$data['city']);  
                    $orderStatus=$this->em->find('Admin\Entity\OrderStatus',1);
                    $data['payment']=$payment; 
                    $data['delivery']=$delivery;
                    $data['city']=$city;
                    $data['order']='some order';
                    $data['orderStatus']=$orderStatus;
//                $order->setOrder($goodsInOrder);        
                    $order->exchangeArray($data);
                    $this->em->persist($order);
//                    var_dump($order); die();
                    $this->em->flush();
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
