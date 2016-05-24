<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\OrderForm;

class OrderController extends AbstractActionController {

    protected $_objectManager;

    public function __construct($em) {
        $this->_objectManager = $em;
    }

    public function indexAction() {
        $entityManager = $this->_objectManager;
        $query = $entityManager->createQuery('SELECT u,a.orderStatus FROM Admin\Entity\Orders u JOIN Admin\Entity\OrderStatus a WHERE u.orderStatus=a.id ORDER BY u.id DESC');
        $rows = $query->getResult();
        $rows[0][0]->setOrderList($this->unserializeEncoded($rows[0][0]->getOrderList()));

        return array('orders' => $rows);
    }

    public function editAction() {
        $form = new OrderForm();
        $cities = $this->getSelectOptions('Cities', 'getCity');
        $payment = $this->getSelectOptions('Payment', 'getPaymentType');
        $delivery = $this->getSelectOptions('Delivery', 'getDeliveryType');
        $orderStatus = $this->getSelectOptions('OrderStatus', 'getOrderStatus');

        $form->get('city')
                ->setValueOptions($cities);
        $form->get('payment')
                ->setValueOptions($payment);
        $form->get('delivery')
                ->setValueOptions($delivery);
        $form->get('orderStatus')
                ->setValueOptions($orderStatus);

        $form->get('submit')->setValue('Save');

        $request = $this->getRequest();
        if (!$request->isPost()) {
            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                $this->flashMessenger()->addErrorMessage('IS is not set');
                return $this->redirect()->toRoute('admin', array('controler' => 'order', 'action' => 'index'));
            }

            $objectManager = $this->_objectManager;

            $order = $objectManager
                    ->find('Admin\Entity\Orders', $id);

            if (!$order) {
                $this->flashMessenger()->addErrorMessage(sprintf('Order with id %s doesn\'t exists', $id));
                return $this->redirect()->toRoute('admin', array('controler' => 'order', 'action' => 'index'));
            }
            
            $order->setOrderList($this->unserializeEncoded($order->getOrderList()));
            // Fill form data.
            $form->bind($order);

            return array('form' => $form, 'cities' => $cities, 'payment' => $payment, 'delivery' => $delivery, 'orderStatus' => $orderStatus);
        } else {
            if ($request->isPost()) {
                $form->setData($request->getPost());

                if ($form->isValid()) {
                    $objectManager = $this->_objectManager;

                    $data = $form->getData();
                    $id = $data['id'];
                    try {
                        $order = $objectManager->find('\Admin\Entity\Orders', $id);
                    } catch (\Exception $ex) {
                        return $this->redirect()->toRoute('admin', array(
                                    'controller' => 'order',
                                    'action' => 'index'
                        ));
                    }

                    $delivery = $this->getObjectManager()->find('Admin\Entity\Delivery', $data['delivery']);
                    $payment = $this->getObjectManager()->find('Admin\Entity\Payment', $data['payment']);
                    $orderStatus = $this->getObjectManager()->find('Admin\Entity\OrderStatus', $data['orderStatus']);
                    $city = $this->getObjectManager()->find('Admin\Entity\Cities', $data['city']);

                    $data['delivery'] = $delivery;
                    $data['payment'] = $payment;
                    $data['orderStatus'] = $orderStatus;
                    $data['city'] = $city;
                    
                    $data['orderList']=trim($data['orderList']);
                    $order_list = explode("\n", $data['orderList']);
                    $order_array = [];

                    foreach ($order_list as $orders) {
                        $item=explode("-", $orders);
                        $item_name=explode(":",$item[1]);
                        $order_array[$item[0]] = array('name'=>$item_name[0],'count'=>(int)$item_name[1]);
                    }

                    $data['orderList'] = serialize($order_array);

                    $order->exchangeArray($data);
                    $objectManager->persist($order);
                    $objectManager->flush();

                    $message = 'Order succesfully saved!';
                    $this->flashMessenger()->addMessage($message);

                    // Redirect to list of blogposts
                    return $this->redirect()->toRoute('admin', array('controller' => 'order', 'action' => 'index'));
                }
            }
        }
    }

    public function searchAction() {
        $searchItem = $this->params()->fromPost('search');
        if (empty($searchItem)) {
            return $this->redirect()->toRoute('admin');
        }
        $query = $this->getObjectManager()->createQuery("SELECT u,a.orderStatus FROM Admin\Entity\Orders u JOIN Admin\Entity\OrderStatus a WHERE u.orderStatus=a.id AND a.orderStatus LIKE '%$searchItem%' ORDER BY u.id DESC ");
        $rows = $query->getResult();
        $rows[0][0]->setOrderList($this->unserializeEncoded($rows[0][0]->getOrderList()));
        return new ViewModel(array('goods' => $rows, 'searchItem' => $searchItem));
    }

    protected function getObjectManager() {
        return $this->_objectManager;
    }

    protected function getSelectOptions($entityName, $field_name) {
        $query = $this->getObjectManager()->createQuery('SELECT u FROM Admin\Entity\\' . $entityName . ' u ');
        $result = $query->getResult();
        $options = array();

        foreach ($result as $option_set) {
            $options[$option_set->getId()] = $option_set->$field_name();
        }

        return $options;
    }
    
    public function unserializeEncoded($order_encoded){
            $order_encoded = unserialize($order_encoded);
            $string = '';
            foreach ($order_encoded as $order_item) {
                $string.=array_search($order_item, $order_encoded) . '-' . $order_item['name'] . ':' . $order_item['count'] . "\n";
            }
            
            return $string;
    }

}
