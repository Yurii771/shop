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
        if (isset($_SESSION['orders'])) {
            $cart = $_SESSION['orders'];
        }
        return array('cities' => $cities, 'payment' => $payment, 'delivery' => $delivery, 'cart' => $cart);
    }

    public function confirmAction() {
        $data = $this->request->getPost();
        if (isset($data['customerName']) && isset($data['customerSurname']) && isset($data['adress']) && isset($data['customerPhone']) && isset($data['customerEmail'])) {
            $validator = new Regex(array('pattern' => '/\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}/'));
            if ($validator->isValid($data['customerPhone'])) {
                $em = $this->getEntityManager();
                $status = 'success';
                $message = 'Ваш заказ оформлен';
                $goodsInOrder = array();
                if (isset($_SESSION['orders'])) {
                    for ($i = 0; $i < count($_SESSION['orders']); $i++) {
                        $id = $_SESSION['orders'][$i]['goods']->getId();
                        $name = $_SESSION['orders'][$i]['goods']->getName();
                        $count = $_SESSION['orders'][$i]['count'];
                        $goodsInOrder[$id] = array(
                            'name' => $name,
                            'count' => $count,
                        );
                    }
                    unset($_SESSION['orders']);
                }
                $order = new Orders;
                $payment = $em->find('Admin\Entity\Payment', $data['payment']);
                $delivery = $em->find('Admin\Entity\Delivery', $data['delivery']);
                $city = $em->find('Admin\Entity\Cities', $data['city']);
                $orderStatus = $em->find('Admin\Entity\OrderStatus', 2);
                $data['payment'] = $payment;
                $data['delivery'] = $delivery;
                $data['city'] = $city;
                $data['orderList'] = serialize($goodsInOrder);
                $data['orderStatus'] = $orderStatus;
                $order->exchangeArray($data);
                $em->persist($order);
                $em->flush();
                if ($message) {
                    $this->flashMessenger()
                            ->setNamespace($status)
                            ->addMessage($message);
                }
                return $this->redirect()->toRoute('guest', array('controller' => 'order', 'action' => 'confirm'));
            } else {
                $status = 'error';
                $message = 'Ошибка при выполнении заказа, проверьте правильность введенных данных';
                if ($message) {
                    $this->flashMessenger()
                            ->setNamespace($status)
                            ->addMessage($message);
                }
                return $this->redirect()->toRoute('guest', array('controller' => 'order', 'action' => 'index'));
            }
        }
    }

}
