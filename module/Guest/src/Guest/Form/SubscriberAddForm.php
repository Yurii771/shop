<?php

namespace Guest\Form;

use Zend\Form\Form;

//use Zend\InputFilter\Factory as InputFactory;
//use Zend\InputFilter\InputFilter;
//use Admin\Filter\CategoryInputFilter;

class SubscriberAddForm extends Form {

	public function __construct($name = null) {
		// we want to ignore the name passed
		parent::__construct('subscriberAddForm');
		$this->setAttribute('method', 'post');
		$this->setAttribute('action', 'subscriber/add');
		$this->setAttribute('class', 'bs-example form-horizontal');
		$this->add(array(
			'name' => 'email',
			'type' => 'email',
			'options' => array(
				//'label' => 'Email',
				'min' => 3,
				'max' => 100,
			),
			'attributes' => array(
				'placeholder' => 'Email',
				'class' => 'form-control',
				'required' => 'required',
			),
		));
		$this->add(array(
			'name' => 'submit',
			'type' => 'Submit',
			'attributes' => array(
				'value' => 'Подписаться',
				'class' => 'btn btn-info',
			),
		));
	}

}
