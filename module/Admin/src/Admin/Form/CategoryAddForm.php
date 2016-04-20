<?php

namespace Admin\Form;

use Zend\Form\Form;

//use Zend\InputFilter\Factory as InputFactory;
//use Zend\InputFilter\InputFilter;
//use Admin\Filter\CategoryInputFilter;

class CategoryAddForm extends Form {

	public function __construct($name = null) {
		// we want to ignore the name passed
		parent::__construct('categoryAddForm');
		$this->setAttribute('method', 'post');
		$this->setAttribute('class', 'bs-example form-horizontal');
		
		//$this->setInputFilter(new CategoryAddInputFilter());

		$this->add(array(
			'name' => 'name',
			'type' => 'text',
			'options' => array(
				'label' => 'Name',
				'min' => 3,
				'max' => 100,
			),
			'attributes' => array(
				'placeholder' => 'Name',
				'class' => 'form-control',
				'required' => 'required',
			),
		));
		$this->add(array(
			'name' => 'parent',
			'type' => 'text',
			'options' => array(
				'label' => 'Parent',
				'min' => 3,
				'max' => 100,
			),
			'attributes' => array(
				'placeholder' => 'Parent',
				'class' => 'form-control',
			),
		));
		$this->add(array(
			'name' => 'submit',
			'type' => 'Submit',
			'attributes' => array(
				'value' => 'Save',
				'class' => 'btn btn-info',
			),
		));
	}

}