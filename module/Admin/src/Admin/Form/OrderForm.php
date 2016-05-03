<?php
namespace Admin\Form;

 use Zend\Form\Form;
 use Admin\Form\OrderEditInputFilter;

 class OrderForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('orderList');
         $this->setAttribute('method', 'post');
         //$this->setInputFilter(new OrderEditInputFilter());
         $this->setAttribute('enctype', 'multipart/form-data');
         
         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         
         $this->add(array(
             'name' => 'orderList',
             'type' => 'Textarea',
             'options' => array(
                 'label' => '',
             ),
             'attributes' => array(
                 'placeholder' => 'Заказ',
                 'class' => 'form-control',
                 'id'=>'order',
             ),
         ));
         $this->add(array(
             'name' => 'customerName',
             'type' => 'Text',
             'options' => array(
                 'label' => '',
             ),
             'attributes' => array(
                 'placeholder' => 'Имя заказчика',
                 'class' => 'form-control',
                 'id'=>'name',

             ),
         ));

         $this->add(array(
             'name' => 'customerSurname',
             'type' => 'Text',
             'options' => array(
                 'label' => '',
                
             ),
             'attributes' => array(
                 'placeholder' => 'Фамилия заказчика',
                 'class' => 'form-control',
                 'id'=>'surname',
             ),
         ));
         
         $this->add(array(
             'name' => 'delivery',
             'type' => 'Select',
             'options' => array(
                 'label' => '',
             ),
             'attributes' => array(
                 'placeholder' => 'Способ доставки',
                 'class' => 'form-control',
                 'id'=>'delivery',
             ),
         ));
         
         $this->add(array(
             'name' => 'payment',
             'type' => 'Select',
             'options' => array(
                 'label' => '',
             ),
             'attributes' => array(
                 'placeholder' => 'Способ оплаты',
                 'class' => 'form-control',
                 'id'=>'payment',
             ),
         ));
         
         $this->add(array(
             'name' => 'orderStatus',
             'type' => 'Select',
             'options' => array(
                 'label' => '',
             ),
             'attributes' => array(
                 'placeholder' => 'Статус заказа',
                 'class' => 'form-control',
                 'id'=>'orderStatus',
             ),
         ));
         
         $this->add(array(
             'name' => 'adress',
             'type' => 'Text',
             'options' => array(
                 'label' => '',
             ),
             'attributes' => array(
                 'placeholder' => 'Адресс',
                 'class' => 'form-control',
                 'id'=>'address',
             ),
         ));
         
         $this->add(array(
             'name' => 'city',
             'type' => 'Select',
             'options' => array(
                 'label' => '',
             ),
             'attributes' => array(
                 'placeholder' => 'Город',
                 'class' => 'form-control',
                 'id'=>'city',
             ),
         ));
         
         $this->add(array(
             'name' => 'customerEmail',
             'type' => 'Text',
             'options' => array(
                 'label' => '',
             ),
             'attributes' => array(
                 'placeholder' => 'Электронная почта',
                 'class' => 'form-control',
                 'id'=>'email',
             ),
         ));
         
         $this->add(array(
             'name' => 'customerPhone',
             'type' => 'Text',
             'options' => array(
                 'label' => '',
             ),
             'attributes' => array(
                 'placeholder' => '',
                 'class' => 'form-control',
                 'id'=>'phone',
             ),
         ));
         
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Submit',
                 'class' => 'btn btn-success',
             ),
         ));
         
     }
     

 }
